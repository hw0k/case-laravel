<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:35
 */

namespace App\Http\Controllers;


use App\Example;
use App\ExampleColumn;
use App\Interest_RF;
use App\Media;
use App\Quiz;
use App\QuizList;
use App\Survey;
use App\Tag;
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

        if($quiz->qu_table == 'example'){
            $quizDetail = new Example();
            $quizDetail->qu_idx = $quiz->qu_idx;
            $quizDetail->ex_type = $request->input('type');
        } else {
            $quizDetail = new Text();
            $quizDetail->qu_idx = $quiz->qu_idx;
            if($request->hasFile('media')){
                $quizDetail->me_idx = $this->addMedia($request->file('media'));
            }
        }

        $quizDetail->save();

        return response()->json(['idx' => $quiz->qu_idx], Response::HTTP_OK);
    }

    public function addColumn(Request $request){
        $exColumn = new ExampleColumn();

        $exColumn->qu_idx = $request->input('quiz');
        $exColumn->ex_co_number = $request->input('number');
        $exColumn->ex_co_ex = $request->input('explain');

        if($request->hasFile('media')){
            $exColumn->me_idx = $this->addMedia($request->file('media'));
        }

        $exColumn->save();

        return response()->json(['idx' => $exColumn->ex_co_idx], Response::HTTP_OK);
    }

    public function createCase(Request $request){
        $case = new Survey();

        $case->ca_title = $request->input('title');
        $case->u_idx = $request->input('user');
        $case->ca_point = $request->input('point');

        $case->save();

        $quizs = $request->input('quiz');
        $counter = 1;
        foreach ($quizs as $quiz){
            $quizList = new QuizList();

            $quizList->ca_idx = $case->ca_idx;
            $quizList->qu_li_sequence = $counter++;
            $quizList->qu_idx = $quiz;

            $quizList->save();
        }

        $tags = $request->input('tags');
        foreach ($tags as $tag){
            $caseTag = new Tag();

            $caseTag->ca_idx = $case->ca_idx;
            $caseTag->i_idx = $tag;

            $caseTag->save();
        }

        return response()->json(['idx' => $case->ca_idx], Response::HTTP_OK);
    }

    public function list(Request $request){
        date_default_timezone_set('Asia/Seoul');

        $list = Survey::all();

        $response = array();
        foreach ($list as $survey){
            $temp = array();
            $temp['ca_idx'] = $survey->ca_idx;
            $temp['ca_title'] = $survey->ca_title;
            $temp['ca_point'] = $survey->ca_point;
            $temp['ca_participant'] = $survey->ca_participant;
            $temp['ca_created'] = date(DATE_ATOM, strtotime($survey->ca_created));
            $temp['u_name'] = $survey->user->u_name;
            $temp['tags'] = Survey::find($survey->ca_idx)->tags;
            array_push($response, $temp);
        }

        return response()->json($response, Response::HTTP_OK);
    }

    public function show(Request $request, $id){

    }

    public function getInterest(Request $request){
        $interests = Interest_RF::all();

        return response()->json($interests, Response::HTTP_OK);
    }

    public function addMedia($file){
        $media = new Media();

        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('uploads/media/', $filename);
        $media->me_path = '/uploads/media/'.$filename;

        $media->save();

        return $media->me_idx;
    }
}