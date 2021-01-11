<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\StoreFaq;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'desc')->paginate(5);
        return view('Manager.faq.list', compact(['faqs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Manager.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaq $request)
    {
        Faq::create([
            'title' => 'Các câu hỏi thường gặp',
            'heading' => $request->heading,
            'content' => $request->get('content')
        ]);
        return redirect()->route('faqs.index')->with('flash_message', 'Thêm FAQ thành công')->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);

        if (empty($faq)) {
            return abort(404);
        }

        return view('Manager.faq.edit', compact(['faq']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFaq $request, $id)
    {
        $faq = Faq::find($id);

        if (empty($faq)) {
            return abort(404);
        }

        $faq->update([
            'heading' => $request->heading,
            'content' => $request->get('content')
        ]);

        return redirect()->route('faqs.index')->with('flash_message', 'Cập nhật FAQ thành công')->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (empty($faq)) {
            return abort(404);
        }

        $faq->delete();
        return redirect()->back()->with('flash_message', 'Xóa FAQ thành công')->with('status', 'success');
    }
}
