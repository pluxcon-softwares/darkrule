<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use Carbon\Carbon;

class TablesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('admins')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('admins')->insert([
            'username' => 'System',
            'email' => 'prolabdomains@gmail.com',
            'password' => Hash::make('@@FOrcehackhts22@@'),
            'access'    => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'username' => 'Admin',
            'email' => 'admin@skullnet.cc',
            'password' => Hash::make('123456'),
            'access'    => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $parentCategory = new Category;
        $parentCategory->category_name = 'Accounts';
        $parentCategory->save();

        $parentCategory = new Category;
        $parentCategory->category_name = 'Tools';
        $parentCategory->save();

        $parentCategory = new Category;
        $parentCategory->category_name = 'Tutorials';
        $parentCategory->save();

        $parentCategory = new Category;
        $parentCategory->category_name = 'Bank Log';
        $parentCategory->save();


        //Adding Data to Products table
        /*DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();
        foreach(range(1, 2) as $index)
        {
            $product = new Product;
            $product->name = $faker->jobTitle;
            $product->description = $faker->text;
            $product->country = $faker->country;
            $product->price = mt_rand(5, 15);
            $product->is_paid = 1;
            $product->sub_category_id = 3;
            $product->save();
        }

        $faker = Faker::create();
        foreach(range(1, 2) as $index)
        {
            $product = new Product;
            $product->name = $faker->jobTitle;
            $product->description = $faker->text;
            $product->country = $faker->country;
            $product->price = mt_rand(5, 15);
            $product->is_paid = 1;
            $product->sub_category_id = 2;
            $product->save();
        }

        $faker = Faker::create();
        foreach(range(1, 2) as $index)
        {
            $product = new Product;
            $product->name = $faker->jobTitle;
            $product->description = $faker->text;
            $product->country = $faker->country;
            $product->price = mt_rand(5, 15);
            $product->is_paid = 1;
            $product->sub_category_id = 1;
            $product->save();
        }

        $faker = Faker::create();
        foreach(range(1, 2) as $index)
        {
            $product = new Product;
            $product->name = $faker->jobTitle;
            $product->description = $faker->text;
            $product->country = $faker->country;
            $product->price = mt_rand(5, 15);
            $product->is_paid = 1;
            $product->sub_category_id = 22;
            $product->save();
        }

        $faker = Faker::create();
        foreach(range(1, 2) as $index)
        {
            $product = new Product;
            $product->name = $faker->jobTitle;
            $product->description = $faker->text;
            $product->country = $faker->country;
            $product->price = mt_rand(5, 15);
            $product->is_paid = 1;
            $product->sub_category_id = 26;
            $product->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('message_boards')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $message_board = new MessageBoard;
        $message_board->title = 'Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.';
        $message_board->body = "Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur aliquet quam id dui posuere blandit.

        Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus.

        Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie malesuada. Donec rutrum congue leo eget malesuada.";
        $message_board->is_published = 1;
        $message_board->admin_id = 2;
        $message_board->save();

        $message_board = new MessageBoard;
        $message_board->title = "Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.";
        $message_board->body = "Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec rutrum congue leo eget malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.";
        $message_board->is_published = 1;
        $message_board->admin_id = 2;
        $message_board->save();

        //Adding sample data to cards table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('cards')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        foreach(range(1, 100) as $index)
        {
            $card_info = new Card();
            $card_info->admin_id = 2;
            $card_info->card_type = $faker->creditCardType;
            $card_info->card_number = $faker->creditCardNumber;
            $card_info->bin = substr($card_info->card_number, 0, 6);
            $card_info->holder = $faker->firstName.' '.$faker->lastName;
            $card_info->exp = $faker->creditCardExpirationDate;
            $card_info->country = $faker->country;
            $card_info->address = $faker->streetAddress;
            $card_info->state = $faker->state;
            $card_info->city = $faker->city;
            $card_info->dob = $faker->creditCardExpirationDate;
            $card_info->ssn = 'None';
            $card_info->base = 'None';
            $card_info->price = mt_rand(5, 15);
            $card_info->save();
        }

        DB::table('about_us')->truncate();
        $about_us = new AboutUs;
        $about_us->content = "Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Pellentesque in ipsum id orci porta dapibus.";
        $about_us->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tickets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $ticket = new Ticket();
        $ticket->user_id = 3;
        $ticket->subject = "Pellentesque in ipsum id orci porta dapibus.";
        $ticket->message = "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur aliquet quam id dui posuere blandit. Cras ultricies ligula sed magna dictum porta.";
        $ticket->status = true;
        $ticket->save();

        $ticket = new Ticket();
        $ticket->user_id = 3;
        $ticket->subject = "Nulla porttitor accumsan tincidunt.";
        $ticket->message = "Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Nulla porttitor accumsan tincidunt. Sed porttitor lectus nibh.";
        $ticket->save();

        $ticket = new Ticket();
        $ticket->user_id = 3;
        $ticket->subject = "Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.";
        $ticket->message = "Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec sollicitudin molestie malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Sed porttitor lectus nibh.";
        $ticket->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ticket_replies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $ticketReply = new TicketReply();
        $ticketReply->reply = "Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Nulla porttitor accumsan tincidunt. Sed porttitor lectus nibh.";
        $ticketReply->ticket_id = 1;
        $ticketReply->user_id = 2;
        $ticketReply->save();

        DB::table('rules')->truncate();
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            $rule = new Rule();
            $rule->rule = $faker->sentence;
            $rule->save();
        } */
    }
}
