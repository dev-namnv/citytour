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
        $this->call(UserSeeder::class);

        // Article
        $this->call(ArticleCategorySeeder::class);
        $this->call(ArticleTagSeeder::class);
        $this->call(ArticleSeeder::class);

        // contact
        $this->call(ContactSeeder::class);

        // Partner
        $this->call(ParnetSeeder::class);

        // Service
        $this->call(FacilitySeeder::class);
        $this->call(ServiceSeeder::class);

        // Product
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);

        // Invoice
        $this->call(InvoiceSeeder::class);

        // Faq
        $this->call(FaqSeeder::class);

        // Slider
        $this->call(SlideSeeder::class);

        // Wishlist
        $this->call(WishlistSeeder::class);
    }
}
