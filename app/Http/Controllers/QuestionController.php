<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerQuestionRequest;
use App\Http\Requests\AskQuestionRequest;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class QuestionController extends Controller
{
    //Add Question Function
    public function addQuestion(AskQuestionRequest $askQuestionRequest)
    {
        Question::create([
            'created_by' => Auth::guard('user')->user()->id,
            'question' => $askQuestionRequest->question,
            'q_date' => Carbon::now(),
        ]);

        return success(null, 'this question added successfully', 201);
    }

    //Edit Question Function
    public function editQuestion(Question $question, AskQuestionRequest $askQuestionRequest)
    {
        $question->update([
            'question' => $askQuestionRequest->question,
        ]);

        return success(null, 'this question updated successfully');
    }

    //Delete Question Function
    public function deleteQuestion(Question $question)
    {
        $question->delete();

        return success(null, 'this question deleted successfully');
    }

    //Get User Questions Function
    public function getUserQuestions()
    {
        $user = Auth::guard('user')->user();
        $questions = User::with(['questions.createdBy', 'questions.answeredBy'])->find($user->id);

        return success($questions, null);
    }

    //Get Questions Function
    public function getQuestions()
    {
        $questions = Question::with(['createdBy', 'answeredBy'])->get();

        return success($questions, null);
    }

    //Get Question Information Function
    public function getQuestionInformation(Question $question)
    {
        $question = $question->with(['createdBy', 'answeredBy'])->find($question->id);

        return success($question, null);
    }

    //Answer Question Function
    public function answerQuestion(Question $question, AnswerQuestionRequest $answerQuestionRequest)
    {
        $question->update([
            'answered_by' => Auth::guard('user')->user()->id,
            'answer' => $answerQuestionRequest->answer,
            'a_date' => Carbon::now(),
        ]);

        return success(null, 'this question answered successfully');
    }
}