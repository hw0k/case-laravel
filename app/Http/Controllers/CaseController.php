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
use App\Example_A;
use App\Interest_RF;
use App\Media;
use App\Quiz;
use App\QuizList;
use App\Survey;
use App\Tag;
use App\Text;
use App\Text_A;
use App\Tournament_A;
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
            if($request->hasFile('media')){
                $quizDetail->me_idx = $this->addMedia($request->file('media'));
            }
        } else {
            $quizDetail = new Text();
            $quizDetail->qu_idx = $quiz->qu_idx;
            $quizDetail->te_type = $request->input('type');
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
        $case->ca_content = $request->input('content');
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
        $list = Survey::all();

        $response = array();
        foreach ($list as $survey){
            $temp = array();
            $temp['ca_idx'] = $survey->ca_idx;
            $temp['ca_title'] = $survey->ca_title;
            $temp['ca_content'] = $survey->ca_content;
            $temp['ca_point'] = $survey->ca_point;
            $temp['ca_participant'] = $survey->ca_participant;
            $temp['ca_created'] = date(DATE_ATOM, strtotime($survey->ca_created));
            $temp['quizs'] = Survey::find($survey->ca_idx)->quizs->count();
            $temp['u_name'] = $survey->user->u_name;
            $temp['tags'] = Survey::find($survey->ca_idx)->tags;
            array_push($response, $temp);
        }

        return response()->json($response, Response::HTTP_OK);
    }

    public function show(Request $request, $id){
        $survey = Survey::findOrFail($id);

        $response = array();
        $response['ca_idx'] = $survey->ca_idx;
        $response['ca_title'] = $survey->ca_title;
        $response['ca_content'] = $survey->ca_content;
        $response['ca_point'] = $survey->ca_point;
        $response['ca_participant'] = $survey->ca_participant;
        $response['ca_created'] = $survey->ca_created;
        $response['u_name'] = $survey->user->u_name;
        $response['tags'] = $survey->tags;

        $quizs = array();
        foreach ($survey->quizs as $quizList){
            $quiz = array();
            $quiz['qu_idx'] = $quizList->qu_idx;
            $quiz['qu_li_sequence'] = $quizList->qu_li_sequence;

            $quizDetail = array();
            $quizDetail['qu_question'] = $quizList->quizDetail->qu_question;
            $quizDetail['qu_table'] = $quizList->quizDetail->qu_table;
            if($quizList->quizDetail->qu_table == 'example')
                $quizDetail['qu_type'] = $quizList->quizDetail->quizExample->ex_type;
            else
                $quizDetail['qu_type'] = $quizList->quizDetail->quizText->te_type;

            $quiz['quiz_detail'] = $quizDetail;
            array_push($quizs, $quiz);
        }
        $response['quizs'] = $quizs;

        return response()->json($response, Response::HTTP_OK);
    }

    public function showLastQuiz(Request $request, $id){
        $quizs = QuizList::where('ca_idx', '=', $id)->get();
        
        foreach($quizs as $quiz){
            $quizDetail = $quiz->quizDetail;

            if($quizDetail->qu_table == 'example')
                $quizType = $quizDetail->quizExample;
            else
                $quizType = $quizDetail->quizText;

            $quizAnswers = $quizType->answers;

            if(count($quizAnswers) != 0){
                foreach($quizAnswers as $quizAnswer){
                    if($quizAnswer->u_idx == $request->input('user')) {
                        break;
                    } else {
                        return response()->json($this->unsetQuiz($quiz), Response::HTTP_OK);
                    }
                }
            } else {
                return response()->json($this->unsetQuiz($quiz), Response::HTTP_OK);
            }
        }

        return response()->json(['status' => 'Already Joined Survey'], Response::HTTP_OK);
    }

    public function showQuiz(Request $request, $id, $sequence){
        $quiz = QuizList::where('ca_idx', '=', $id)->where('qu_li_sequence','=', $sequence)->firstOrFail();

        $quizDetail = $quiz->quizDetail;

        if($quizDetail->qu_table == 'example') {
            $quizExample = $quizDetail->quizExample;
            $columns = $quizExample->columns;
            foreach($columns as $column){
                if($column->me_idx != null)
                    $column->media;
            }
        } else {
            $quizText = $quizDetail->quizText;
            if($quizText->me_idx != null)
                $quizText->media->me_name;
        }
        return response()->json($this->unsetQuiz($quiz), Response::HTTP_OK);
    }

    public function solve(Request $request){
        $quizIdx = $request->input('quiz');
        $userIdx = $request->input('user');
        
        $quiz = Quiz::where('qu_idx', '=', $quizIdx)->firstOrFail();

        if($quiz->qu_table == 'example') {
            $answer = new Examle_A();
            $answer->ex_a_answer = $request->input('answer');
        } else {
            $answer = new Text_A();
            $answer->te_a_answer = $request->input('answer');
        }

        $answer->qu_idx = $quizIdx;
        $answer->u_idx = $userIdx;
        
        $answer->save();

        return response()->json($answer, Response::HTTP_OK);
    }

    public function startTournament(Request $request){
        $quiz = Quiz::where('qu_idx', '=', $request->input('quiz'))->firstOrFail();
  
        $quizExample = $quiz->quizExample;
        $columns = $quizExample->columns;

        foreach($columns as $column){
            unset($column->qu_idx);
            unset($column->ex_co_number);
        }

        unset($quiz->qu_rAnswer);
        unset($quizExample->me_idx);
        unset($quizExample->qu_idx);

        return response()->json($columns, Response::HTTP_OK);
    }

    public function chooseTournament(Request $request){
        if($request->input('round') != 1){
            $answer = new Tournament_A();
            $answer->u_idx = $request->input('user');
            $answer->to_a_round = $request->input('round');
            $answer->ex_co_idx = $request->input('column');

            $answer->save();
        } else {
            $answer = new Example_A();
            $answer->u_idx = $request->input('user');
            $answer->qu_idx = $request->input('quiz');
            $answer->ex_a_answer = $request->input('column');

            $answer->save();

            Tournament_A::where('u_idx', '=', $request->input('user'))->delete();
        }

        return response()->json($answer, Response::HTTP_OK);
    }

    public function nextRound(Request $request){
        $selectColumns = Tournament_A::where('to_a_round', '=', $request->input('round'))
                            ->where('u_idx', '=', $request->input('user'))->get();
        
        $response = array();
        foreach($selectColumns as $selectColumn){
            $column = $selectColumn->column;
            unset($column->qu_idx);
            unset($column->ex_co_number);
            array_push($response, $column);
        }

        return response()->json($response, Response::HTTP_OK);
    }

    public function getInterest(Request $request){
        $interests = Interest_RF::all();

        return response()->json($interests, Response::HTTP_OK);
    }

    public function addMedia($file){
        $media = new Media();

        $extension = $file->getClientOriginalExtension();
        $media->me_type = $extension;
        $filename = time().'.'.$extension;
        $file->move('uploads/media/', $filename);
        $media->me_path = '/uploads/media/'.$filename;

        $media->save();

        return $media->me_idx;
    }

    public function unsetQuiz($quiz){
        $quizDetail = $quiz->quizDetail;
        
        if($quizDetail->qu_table == 'example'){
            $quizType = $quizDetail->quizExample;
        } else {
            $quizType = $quizDetail->quizText;
        }

        unset($quizDetail->qu_idx);
        unset($quizType->qu_idx);
        unset($quizType->answers);

        return $quiz;
    }
}