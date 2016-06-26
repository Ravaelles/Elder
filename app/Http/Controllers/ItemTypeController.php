<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateItemTypeRequest;
use App\Http\Requests\UpdateItemTypeRequest;
use App\Libraries\Repositories\ItemTypeRepository;
use Flash;
use Mitul\Controller\AppBaseController as AppBaseController;
use Response;

class ItemTypeController extends AppBaseController
{

	/** @var  ItemTypeRepository */
	private $itemTypeRepository;

	function __construct(ItemTypeRepository $itemTypeRepo)
	{
		$this->itemTypeRepository = $itemTypeRepo;
	}

	/**
	 * Display a listing of the ItemType.
	 *
	 * @return Response
	 */
	public function index()
	{
		$itemTypes = $this->itemTypeRepository->paginate(10);

		return view('itemTypes.index')
			->with('itemTypes', $itemTypes);
	}

	/**
	 * Show the form for creating a new ItemType.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('itemTypes.create');
	}

	/**
	 * Store a newly created ItemType in storage.
	 *
	 * @param CreateItemTypeRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateItemTypeRequest $request)
	{
		$input = $request->all();

		$itemType = $this->itemTypeRepository->create($input);

		Flash::success('ItemType saved successfully.');

		return redirect(route('itemTypes.index'));
	}

	/**
	 * Display the specified ItemType.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$itemType = $this->itemTypeRepository->find($id);

		if(empty($itemType))
		{
			Flash::error('ItemType not found');

			return redirect(route('itemTypes.index'));
		}

		return view('itemTypes.show')->with('itemType', $itemType);
	}

	/**
	 * Show the form for editing the specified ItemType.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$itemType = $this->itemTypeRepository->find($id);

		if(empty($itemType))
		{
			Flash::error('ItemType not found');

			return redirect(route('itemTypes.index'));
		}

		return view('itemTypes.edit')->with('itemType', $itemType);
	}

	/**
	 * Update the specified ItemType in storage.
	 *
	 * @param  int              $id
	 * @param UpdateItemTypeRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateItemTypeRequest $request)
	{
		$itemType = $this->itemTypeRepository->find($id);

		if(empty($itemType))
		{
			Flash::error('ItemType not found');

			return redirect(route('itemTypes.index'));
		}

		$this->itemTypeRepository->updateRich($request->all(), $id);

		Flash::success('ItemType updated successfully.');

		return redirect(route('itemTypes.index'));
	}

	/**
	 * Remove the specified ItemType from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$itemType = $this->itemTypeRepository->find($id);

		if(empty($itemType))
		{
			Flash::error('ItemType not found');

			return redirect(route('itemTypes.index'));
		}

		$this->itemTypeRepository->delete($id);

		Flash::success('ItemType deleted successfully.');

		return redirect(route('itemTypes.index'));
	}
}
