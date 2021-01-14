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
use Cknow\Money\Money;
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
        $tours = Tour::query()->whereHas('invoices.user', function ($q) {
            $q->orderBy('created_at', 'desc');
        });
        $invoices = Invoice::query();

        if (auth()->user()->role === GUIDE) {
            $tours = $tours->ofGuide();
            $invoices = $invoices->ofGuide();
        }
        $invoices = $invoices->get();
        $monthTours = $tours->whereHas('invoices', function ($q) {
            $q->where('created_at', '>=', Carbon::parse()->startOfMonth());
        })->get();
        $weekTours = $tours->whereHas('invoices', function ($q) {
            $q->where('created_at', '>=', Carbon::parse()->startOfWeek());
        })->get();
        $dayTours = $tours->whereHas('invoices', function ($q) {
            $q->where('created_at', '>=', Carbon::parse());
        })->get();

        $weekIncome = 0;
        foreach ($invoices as $invoice) {
            if (Carbon::parse($invoice->created_at)->isCurrentWeek()) {
                $weekIncome += $invoice->getRawOriginal('total_cost');
            }
        }

        $classActivities = ['danger', 'primary', 'success', 'default', 'secondary', 'warning'];

        if (auth()->user()->role === ADMIN) {
            $weekIncome = $weekIncome * 0.05;
        }
        $weekIncome = Money::VND($weekIncome);

        return view(
            'Manager.dashboard.sale',
            compact(
                'invoices',
                'classActivities',
                'weekIncome',
                'monthTours',
                'weekTours',
                'dayTours'
            )
        );
    }

}
