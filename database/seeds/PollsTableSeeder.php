<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create();
        for ($i = 0; $i < 15; $i++) {
            $poll = new App\Poll();
            $poll->question = preg_replace('/\.$/', '?', $faker->sentence());
            $poll->save();

            foreach ($faker->words as $option) {
                $stat = new App\Stat();
                $stat->option = $option;
                $stat->vote_count = 0;
                $poll->stats()->save($stat);
            }
        }
    }
}
