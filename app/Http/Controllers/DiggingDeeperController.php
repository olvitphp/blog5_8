<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller
{
    /**
     * Базовая информация
     * @url
     *
     *
     */

    public function collections()
    {
        $result = [];


        $eloquentCollection = BlogPost::withoutTrashed()->get();

      //  dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());


        $collection = collect($eloquentCollection->toArray());

//        dd(
//            get_class($eloquentCollection),
//        get_class($collection),
//        $collection
//    );

//        $result['first'] = $collection->first();
//        $result['last'] = $collection->last();
//
//        $result['where']['data'] = $collection
//            ->where('category_id', 11)
//            ->values()
//            ->keyBy('id')
//            ;

//
//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isEmpty'] = $result['where']['data']->isNotEmpty();
       // dd($result);
//
//        $result['where_first'] = $collection
//            ->firstWhere('created_at', '>', '2019-12-26 01:37:45');
//        dd($result);

//        $result['map']['all'] = $collection->map(function (array $item) {
//
//           $newItem = new \stdClass();
//           $newItem->item_id = $item['id'];
//           $newItem->item_name = $item['title'];
//           $newItem->exists = is_null($item['deleted_at']);
//
//           return $newItem;
//        });

       // dd($result);
//
//        $result['map']['not_exists'] = $result['map']['all']
//            ->where('exists', '=', false)
//            ->values()
//            ->keyBy('item_id');

     //   dd($result);
        $collection->transform(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;

        });
      //  dd($collection);

//        $newItem = new \stdClass();
//        $newItem = 9999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 888;

       // dd($newItem, $newItem2);
//         $collection->prepend($newItem);
//         $collection->push($newItem2);
//            dd($newItem, $newItem2, $collection);

//        $newItemFirst = $collection->prepend($newItem)->first;
//        $newItemLast = $collection->push($newItem2)->last();
//        $pulledItem = $collection->pull(10);
//
//        dd(compact('collection', 'newItemFirst', 'newItemLast', 'pulledItem'));

//        $filtered = $collection->filter(function ($item) {
//           $byDay = $item->created_at->isFriday();
//           $byDate = $item->created_at->day == 7;
//
//          // $result = $item->created_at->isFriday() && ($item->created_at->day == 11);
//
//
//           $result = $byDay && $byDate;
//
//           return $result;
//
//        });
//        dd(compact('filtered'));

        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dd(compact('sortedSimpleCollection', 'sortedAscCollection',
        'sortedDescCollection'));


    }
}

