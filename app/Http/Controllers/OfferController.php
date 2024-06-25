<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    //Add Offer Function
    public function addOffer(OfferRequest $offerRequest)
    {
        Offer::create([
            'created_by' => Auth::guard('user')->user()->id,
            'trip_id' => $offerRequest->trip_id,
            'name' => $offerRequest->name,
            'description' => $offerRequest->description,
        ]);

        return success(null, 'this offer added successfully', 201);
    }

    //Edit Offer Function
    public function editOffer(Offer $offer, OfferRequest $offerRequest)
    {
        $offer->update([
            'trip_id' => $offerRequest->trip_id,
            'name' => $offerRequest->name,
            'description' => $offerRequest->description,
        ]);

        return success(null, 'this offer updated successfully', 201);
    }

    //Delete Offer Function
    public function deleteOffer(Offer $offer)
    {
        $offer->delete();

        return success(null, 'this offer deleted successfully', 201);
    }

    //Get Offers Function
    public function getOffers()
    {
        $offers = Offer::with('createdBy', 'trip')->get();

        return success($offers, null);
    }

    //Get Offer Information Function
    public function getOfferInformation(Offer $offer)
    {
        return success($offer->with('createdBy', 'trip')->find($offer->id), null);
    }
}