<?php

namespace App\Http\Controllers\Hq;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ScaffoldController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $model = $this->getModel($request);
        if ($model !== null) {
            return $this->listObjects($request, $model);
        } else {
//            return $this->dashboard($request);
            die('nothing to show, empty model');
        }
    }

//    private function dashboard($request) {
//        $rawModels = glob(app_path("*.php"));
//        $models = [];
//        $appPath = app_path("");
//        foreach ($rawModels as $rawFile) {
//            $models[$rawFile] = substr(str_replace([$appPath, ".php"], "", $rawFile), 1);
//        }
//
//        return $this->view('dashboard.dashboard', compact('models'));
//    }

    private function listObjects($request, $model)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'list');

        // ======================================================================================

        $modelName = $this->getModelName($request, true);
        if (!empty($sortOption = $model->getScaffoldOption('sort'))) {
            $sort = $sortOption;
        } else {
            $sort = ['name' => 'asc', $model->getPrimaryKey() => 'desc'];
        }

        // === Get objects ======================================================================

        // Sort
        $rawObjects = $model;
        foreach ($sort as $key => $value) {
            $rawObjects = $rawObjects->orderBy($key, $value);
        }

        // Paginate
        $perPage = $model->getScaffoldOption('per_page');
        $rawObjects = $rawObjects->paginate($perPage > 0 ? $perPage : 10);

        // =========================================================================

        $fields = $model->getScaffoldSchema($model);
//        dump($fields);
//        dd($rawObjects->toArray()['data']);
        $scaffoldedObjects = $model->getScaffoldedObjects($rawObjects->toArray()['data']);

        return $this->view('actions.index-scaffold', [
                'scaffoldedObjects' => $scaffoldedObjects,
                'model' => $model,
                'rawObjects' => $rawObjects,
                'fields' => $fields,
                'modelName' => $this->getModelName($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'create');

        // =========================================================================

        $model = $this->getModel($request);
        $modelName = $this->getModelName($request, true);
        $fields = $model->getScaffoldSchema($model);

        $scaffoldedObject = $model->getScaffoldedObjects([$model->toArray()], true)[0];

        return $this->view('actions.create-scaffold', [
                'fields' => $fields,
                'scaffold' => $model,
                'modelName' => $this->getModelName($request),
                'model' => $model,
                'scaffoldedObject' => $scaffoldedObject,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'create');

        // =========================================================================

        $modelName = $this->getModelName($request, true);
        $object = new $modelName();

        $this->assignAllValidFieldsToObject($object, $request);
        $object->save();

        $modelName = $this->getModelName($request, false);
        flash("$modelName added!", 'success');
        return redirect()->route(
                config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'show');

        // =========================================================================

        $model = $this->getModel($request);
        $modelName = $this->getModelName($request, true);
        $fields = $model->getScaffoldSchema($model);

        $rawObject = $modelName::findOrFail($id);
        $scaffoldedObject = $model->getScaffoldedObjects([$rawObject->toArray()], true)[0];

        return $this->view('actions.show-scaffold', [
                'fields' => $fields,
                'modelName' => $this->getModelName($request),
                'rawObject' => $rawObject,
                'scaffoldedObject' => $scaffoldedObject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'edit');

        // =========================================================================

        $model = $this->getModel($request);
        $modelName = $this->getModelName($request, true);
        $fields = $model->getScaffoldSchema($model);

        $rawObject = $modelName::findOrFail($id);
        $scaffoldedObject = $model->getScaffoldedObjects([$rawObject->toArray()], true)[0];

        return $this->view('actions.edit-scaffold', [
                'fields' => $fields,
                'rawObject' => $rawObject,
                'scaffoldedObject' => $scaffoldedObject,
                'modelName' => $this->getModelName($request)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'update');

        // =========================================================================

        $id = $request->get('id');
        $modelName = $this->getModelName($request, true);
        $object = $modelName::findOrFail($id);

        $this->assignAllValidFieldsToObject($object, $request);
        $object->save();

        $modelName = $this->getModelName($request);
        flash("$modelName updated successfully.", 'info');

        return redirect()->route(config('scaffold.route-base-name') . '.index', ['scaffold' => $this->getModelName($request)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {

        // === Verify that request is allowed ===================================================

        $this->makeSureRequestIsAllowed($request, 'delete');

        // =========================================================================

        $modelName = $this->getModelName($request, true);
        $object = $modelName::findOrFail($id);
        $object->delete();

        $modelName = $this->getModelName($request);

        flash("$modelName deleted.", 'danger');
        return redirect()->route(config('scaffold.route-base-name') . '.index', ['scaffold' => $modelName]);
    }

    // =========================================================================

    private function view($viewName, $params = []) {
        return View::make('hq.scaffold.' . $viewName, $params);
    }

    private function makeSureRequestIsAllowed(Request $request, $mode)
    {
        $mode = strtolower($mode);
        if ($mode === 'destroy') {
            $mode = 'delete';
        }

        $model = $this->getModel($request);

        $modeUppercase = strtoupper($mode);
        $optionValue = $model->getScaffoldOption("actions.$mode");
        if ($optionValue !== null && $optionValue !== true) {
            die("Not allowed to $modeUppercase. Set model scaffold option `actions.$mode` to true.");
        } else {
            return true;
        }
    }

    private function getModel($request) {
//        $modelName = $request->get("model");
//        if (strlen($modelName)) {
//            $model = app("App\\{$modelName}");
//            return $model;
//        } else {
//            dd($request->path());
//            return null;
//        }

        $modelName = $this->getModelName($request);

        $model = app("App\\{$modelName}");
        return $model;
    }

    private function getModelName($request, $prefixWithApp = false) {
//        $model = $request->get("model");
//        if (strlen($model)) {
//            return ($prefixWithApp ? "App\\" : "") . $model;
//        } else {
//            return null;
//      
        if (empty($this->model)) {
            if ($request->has('scaffolded')) {
                $uri = $request->all()['scaffolded'];
            } else if ($request->has('scaffold')) {
                $uri = $request->all()['scaffold'];
            } else {
                $uri = $request->segments()[count($request->segments()) - 1];
            }
        }

//        $uri = $request->path();
        $modelName = ucwords(str_ireplace("hq/", "", $uri));
        $modelName = str_singular($modelName);
        $fullModelName = "App\\" . $modelName;

        // Check if model exists
        if (!class_exists($fullModelName)) {
            die("Model $fullModelName does not exist.");
        }

        // =========================================================================
        // === Verify if is allowed to scaffold this model =========================
        if (config('scaffold.allowed-models') !== null) {
            if (!in_array($fullModelName, config('scaffold.allowed-models'))) {
                die("Model <b>$fullModelName</b> is not allowed to be scaffolded.<br /><br />"
                    . "Go to the config file `<i>scaffold.allowed-models</i>` "
                    . "and add to the array this line:<br /><br />"
                    . "<b>$fullModelName::class,</b>");
            }
        }

        // =========================================================================

        $result = ($prefixWithApp ? "App\\" : "") . $modelName;

        return $result;
    }

    private function assignAllValidFieldsToObject($object, $request) {
        foreach ($request->all() as $name => $value) {
            if (!in_array($name, ['_id', '_created', '_updated', 'scaffold', '_method', '_token', 'id'])) {
                $object->$name = $value;
            }
        }
    }

    // =========================================================================

//    private function getScaffoldOption($optionName, $modelName) {
//        if (isset($modelName::$scaffoldOptions) && isset($modelName::$scaffoldOptions[$optionName])) {
//            return $modelName::$scaffoldOptions[$optionName];
//        } else {
//            return null;
//        }
//    }
//
//    private function getScaffoldSchema($model) {
//        $class = get_class($model);
//
//        if (isset($modelName::$scaffoldFields)) {
//            return $class::$scaffoldFields;
//        } else {
//            return [];
//        }
//    }
}
