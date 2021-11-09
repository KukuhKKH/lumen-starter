<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Example Repository
     *
     * @var ExampleRepository
     */
    private $exampleRepository;

    /**
     * Constructor
     *
     * @param ExampleRepository $exampleRepository
     */
    public function __construct(ExampleRepository $exampleRepository) {
        $this->exampleRepository = $exampleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $example = $this->exampleRepository->index();
        return response()->success($example, "", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $example = $this->exampleRepository->show($id);
            return response()->success($example, "", 200);
        } catch (\Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $example = $this->exampleRepository->create($request);
            return response()->success($example, 'Berhasil menambahkan example.', 201);
        } catch (\Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $example = $this->exampleRepository->update($request, $id);
            return response()->success($example, 'Berhasil mengubah example.', 200);
        } catch (\Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $example = $this->exampleRepository->delete($id);
            return response()->success($example, 'Berhasil menghapus example.', 200);
        } catch (\Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }
}
