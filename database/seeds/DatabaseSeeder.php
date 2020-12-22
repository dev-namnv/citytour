<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Common seeder
//        $this->call(UserSeeder::class);

        // Article
//        $this->call(ArticleCategorySeeder::class);
//        $this->call(ArticleTagSeeder::class);
//        $this->call(ArticleSeeder::class);

        // Contact
//        $this->call(ContactSeeder::class);

        // Service
//        $this->call(ServiceSeeder::class);
//        $this->call(Category::class);
//        $this->call(TourSeeder::class);

        // Invoice
//        $this->call(InvoiceSeeder::class);

        // Faq
        $this->call(FaqSeeder::class);

        // Slider
//        $this->call(SlideSeeder::class);

        // Wishlist
//        $this->call(WishlistSeeder::class);

        // Cancel policy
//        $this->call(CancelPolicySeeder::class);
    }
}
