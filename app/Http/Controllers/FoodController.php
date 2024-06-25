<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    //Add Food Function
    public function addFood(FoodRequest $foodRequest)
    {
        Food::create([
            'created_by' => Auth::guard('user')->user()->id,
            'name' => $foodRequest->name,
            'description' => $foodRequest->description,
        ]);

        return success(null, 'this food added successfully', 201);
    }

    //Edit Food Function
    public function editFood(Food $food, FoodRequest $foodRequest)
    {
        $food->update([
            'name' => $foodRequest->name,
            'description' => $foodRequest->description,
        ]);

        return success(null, 'this food updated successfully');
    }

    //Delete Food Function
    public function deleteFood(Food $food)
    {
        $food->delete();

        return success(null, 'this food deleted successfully');
    }

    //Get Foods Function
    public function getFoods()
    {
        $foods = Food::get();

        return success($foods, null);
    }

    //Get Food Information
    public function getFoodInformation(Food $food)
    {
        return success($food, null);
    }
}
