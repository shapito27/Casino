<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:34
 */

namespace App\Services;

use App\Exceptions\SubjectNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

/**
 * Class Subject - entity of specific item
 * @package App\Services
 */
class Subject
{
    /**
     * @return \App\Models\Subject|\Illuminate\Database\Eloquent\Model
     */
    public function getRandom()
    {
        try{
            return \App\Models\Subject::where('available', 1)->inRandomOrder()->firstOrFail();
        }catch (ModelNotFoundException $exception){
            Log::critical('Subject not found!');
            throw new SubjectNotFoundException();
        }
    }

    /**
     * @param array $fields
     * @return \App\Models\Subject
     */
    public function add(array $fields)
    {
        $newSubject = new \App\Models\Subject();
        $newSubject->name = $fields['name'];
        $newSubject->description = $fields['description'];
        $newSubject->available = 1;
        $newSubject->save();

        return $newSubject;
    }

    /**
     * @param int $subjectId
     * @return bool
     */
    public static function markAsNotAvailable(int $subjectId):bool
    {
        try {
            \App\Models\Subject::findOrFail($subjectId)->update(['available' => 0]);

            return true;
        } catch (ModelNotFoundException $exception) {
            Log::critical($exception);

            return false;
        }
    }

    /**
     * @param int $id
     * @return \App\Models\Subject|\App\Models\Subject[]|bool|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public static function findById(int $id)
    {
        try {
            return \App\Models\Subject::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            Log::critical($exception);

            return false;
        }

    }
}