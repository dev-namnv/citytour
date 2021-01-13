<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Tour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function analytic(Request $request)
    {
        $users = $this->getAll($request,User::query());
        $invoices = $this->getAll($request,Invoice::query());
        $articles = $this->getAll($request, Article::where('user_id', '=', auth()->user()->id));
        $article_categories = $this->getAll($request, ArticleCategory::query());
        $categories = $this->getAll($request, Category::query());
        $tours = $this->getAll($request, Tour::where('guide_id', '=', auth()->user()->id));

        if (auth()->user()->role == ADMIN) {
            $countCategories = $countArticleCategories = $countUsers = $countGuides = $totalIncome = $countInvoices = 0;

            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]->role == \USER) {
                    $countUsers++;
                }

                if ($users[$i]->role == GUIDE) {
                    $countGuides++;
                }
            }

            for ($i = 0; $i < count($invoices); $i++) {
                $countInvoices++;
                $totalIncome += $invoices[$i]->getRawOriginal('total_cost');
            }

            for ($i = 0; $i < count($article_categories); $i++) {
                $countArticleCategories++;
            }

            for ($i = 0; $i < count($categories); $i++) {
                $countCategories++;
            }

            return view('Manager.dashboard.analytic', compact(['countGuides', 'countUsers', 'countInvoices', 'totalIncome', 'countArticleCategories', 'countCategories']));
        }

        if (auth()->user()->role == GUIDE) {
            $invoices = $invoices->where('guide_id', '=', auth()->user()->id);
            $countUsers = $invoices->groupBy('user_id')->count();
            $countInvoices = $invoices->count();
            $countTours = $tours->count();
            $countArticles = $articles->count();

            $totalIncome = $invoices->sum(function ($invoice) {
                return $invoice->getRawOriginal('total_cost');
            });

            return view('Manager.dashboard.analytic', compact(['countUsers', 'countInvoices', 'totalIncome', 'countTours', 'countArticles']));
        }

    }

    public function sale()
    {
        $currentDate = Carbon::now();
        $nowDate = $currentDate->subDays($currentDate->dayOfWeek + 1);
        $invoices = Invoice::query()->where('created_at', '>=', $nowDate);

        if (auth()->user()->role === GUIDE) {
            $invoices = $invoices->ofGuide();
        }
        $invoices = $invoices->get();

        return view('Manager.dashboard.sale');
    }

    public function getAll($request,$query)
    {
        if ($request->has('date') || $request->has('type')){
            $date = $request->date ?? date('d-m-Y');
            $type = $request->type ?? 'days';
            $results = $this->getOnTime($query,$date,$type);
        }else{
            $results = $query->get();
        }
        return $results;
    }
}
