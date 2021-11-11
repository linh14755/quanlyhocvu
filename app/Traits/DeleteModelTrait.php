<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteModelTrait
{
    public function deleteModelTrait($name_id, $id, $model)
    {
        try {
            $model->where($name_id, $id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());

            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
