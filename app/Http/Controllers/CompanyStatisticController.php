<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatisticRequest;
use App\Http\Requests\UpdateStatisticRequest;
use App\Models\CompanyStatistic;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompanyStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $statistics = CompanyStatistic::orderByDesc('id')->paginate(10);
        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.statistics.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreStatisticRequest $request)
    {
        // dd($request->all()); // Memastikan data yang diterima sudah benar
        // insert kepada database bakalan disini
        // closure-based transactions are used to ensure that all operations within the closure are treated as a single unit of work. If any operation fails, the entire transaction is rolled back, ensuring data integrity.
        // This is particularly useful when you need to perform multiple database operations that depend on each other
        // and you want to ensure that either all operations succeed or none do.
        // This helps maintain the integrity of your database and prevents partial updates that could lead to inconsistent
        DB::transaction(function() use ($request) {
            $validated=$request->validated();

            if($request->hasFile('icon')){
                $iconPath=$request->file('icon')->store('icons', 'public');
                $validated['icon']=$iconPath;
            }

            $newDataRecord = CompanyStatistic::create($validated);

        });
        
        return redirect()->route('admin.statistics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyStatistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyStatistic $statistic)
    {
        //
        return view('admin.statistics.edit', compact('statistic'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatisticRequest $request, CompanyStatistic $statistic)
    {
        //
        DB::transaction(function() use ($request, $statistic) {
            $validated=$request->validated();

            if($request->hasFile('icon')){
                $iconPath=$request->file('icon')->store('icons', 'public');
                $validated['icon']=$iconPath;
            }

            $statistic->update($validated);

        });
        
        return redirect()->route('admin.statistics.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyStatistic $statistic)
    {
        //
        DB::transaction(function() use ($statistic) {
            $statistic->delete();
        });
        return redirect()->route('admin.statistics.index');
    }
}