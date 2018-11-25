<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:34
 */

namespace App\Services;

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
        return \App\Models\Subject::where('available', '=', 1)->inRandomOrder()->firstOrFail();
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

    public function markAsNotAvailable(int $subjectId)
    {
        \App\Models\Subject::findOrFail($subjectId)->update(['available' => 0]);

        return true;
    }
}