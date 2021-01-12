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
    public function analytic()
    {
        $users = User::all();
        $invoices = Invoice::all();
        $articles = Article::where('user_id', '=', auth()->user()->id)->get();
        $article_categories = ArticleCategory::all();
        $categories = Category::all();
        $tours = Tour::where('guide_id', '=', auth()->user()->id)->get();

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

        $totalIncome = $invoices->sum(function ($invoice) {
            return $invoice->getRawOriginal('total_cost');
        });

        $classActivities = ['danger', 'primary', 'success', 'default', 'secondary', 'warning'];

        return view('Manager.dashboard.sale', compact('invoices', 'totalIncome', 'classActivities'));
    }

}
