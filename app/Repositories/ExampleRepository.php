<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExampleRepository {
    /**
     * Cache key list example.
     *
     * @var array
     */
    public const CACHE_KEY_LIST_ROLES = 'example';

    /**
     * Cache key show example.
     *
     * @var array
     */
    public const CACHE_KEY_SHOW_ROLES = 'show_example_';

    /**
     * Default cache expired time.
     *
     * @var int
     */
    protected $cacheExpired = (60 * 5); // 5 minutes in seconds

    /**
     * Index all example.
     *
     * @param void
     * @return Pos
     */
    public function index() {
        try {
            return Cache::remember(self::CACHE_KEY_LIST_ROLES, $this->cacheExpired, function () {
                return Example::all();
            });
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get Example by id.
     *
     * @param int $id
     * @return Pos
     */
    public function show($id) {
        try {
            return example::findOrFail($id);
        } catch (\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    /**
     * Create new Example.
     *
     * @param Request $request
     * @return Example|bool
     */
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $example = Example::create($request->all());
            DB::commit();
            $this->flushCache($example->id);
            return $example;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e; report($e); return $e;
        }
    }

    /**
     * Update Example by id.
     *
     * @param Request $request
     * @param int $id
     * @return Pos|bool
     */
    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $example = Example::findOrFail($id);
            $example->update($request->all());
            DB::commit();
            $this->flushCache($id);
            return $example;
        } catch(ModelNotFoundException $e) {
            DB::rollback();
            throw new \Exception("Data tidak ditemukan", 404);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e; report($e); return $e;
        }
    }

    /**
     * Delete example by id.
     *
     * @param Request $request
     * @param int $id
     * @return Example|bool
     */
    public function delete($id) {
        DB::beginTransaction();
        try {
            $example = Example::findOrFail($id);
            $example->delete();
            DB::commit();
            $this->flushCache($id);
            return $example;
        } catch(ModelNotFoundException $e) {
            DB::rollback();
            throw new \Exception("Data tidak ditemukan", 404);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e; report($e); return $e;
        }
    }

    /**
     * Forget example cache
     *
     * @param void
     * @return void
     */
    public function flushCache($slug = '') {
        Cache::forget(self::CACHE_KEY_LIST_ROLES);
        Cache::forget(self::CACHE_KEY_SHOW_ROLES . $slug);
    }
}
