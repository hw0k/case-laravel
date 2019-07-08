<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:35
 */

namespace App\Http\Controllers;


use App\Example;
use App\Media;
use App\Quiz;
use App\Survey;
use App\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CaseController
{
    public function createQuiz(Request $request){
        $quiz = new Quiz();

        $quiz->qu_question = $request->input('question');
        $quiz->qu_rAnswer = $request->input('answer');
        $quiz->qu_table = $request->input('table');

        $quiz->save();

        if($quiz->qu_table == 'EXAMPLE'){
            $quizDetail = new Example();
            $quizDetail->ex_type = $request->input('type');
        } else {
            $quizDetail = new Text();
            if($request->hasFile('media')){
                $media = new Media();
                $file = $request->file('media');

                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/media/', $filename);

                $media->me_path = '/uploads/media/'.$filename;

                $media->save();
                $quizDetail->me_idx = $media->me_idx;
            }
        }

        $quizDetail->save();

        return response()->json(['idx' => $quiz->qu_idx], Response::HTTP_OK);
    }
}