<?php

use Illuminate\Database\Seeder;
use App\Services\ProductSearchService;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /**
     * @var ProductSearchService
     */
    private $productSearchService;

    public function __construct(ProductSearchService $productSearchService)
    {
        $this->productSearchService = $productSearchService;
    }

    public function run()
    {
//        factory(App\Product::class, 100)->create();

        $queries = ['teminator', 'hulk', 'matrix', 'rambo', 'titanic', 'disaster movie', 'The Perks of Being a Wallflower',
                    'rocky', 'avatar', 'saw', 'the parent trap', 'booksmart', 'The Sixth Sense', 'Edward Scissorhands', 'Harry Potter',
                    'Bridesmaids', 'Love Actually', 'e.t.', 'ocean', 'signs', 'Crazy Rich Asians', 'Jumanji', 'Coyote Ugly',
                    'The Boy In The Striped Pajamas', 'Hocus Pocus', 'tarzan', 'The Fault In Our Stars', 'Water For Elephants',
                    'Willy Wonka & The Chocolate Factory', 'Across The Universe', 'On the Basis of Sex', 'Changeling', 'room',
                    'The Imitation Game', 'jurassic park', 'Interview With the Vampire: The Vampire Chronicles', 'The Chronicles Of Narnia: The Lion, the Witch & the Wardrobe',
                    'Mrs. Doubtfire', 'sleepy hollow', 'the day after tomorrow', 'clueless', 'beetlejuice', 'freedom writers', 'napoleon dynamite',
                    'remember the titans', 'the goonies', 'spice world', 'stuck in love', 'mean girls', 'the princess bride', 'the invitation',
                    'back to the future', 'Mamma Mia! The Movie', 'the hills have eyes', 'now and then', 'the notebook', 'black panther', 'the mist',
                    'Pride & Prejudice', 'the dark knight', 'Extremely Wicked, Shockingly Evil and Vile', 'taken', 'the wizard of oz', '50 first dates',
                    'Lemony Snicket\'s A Series of Unfortunate Events', 'scream', 'stick it', 'house of wax', 'practical magic', 'midnight in paris',
                    'matilda', 'bohemian rhapsody', 'panic room', 'the hunger games', 'girl, interupted', 'the happening', 'crazy, stupid, love',
                    'something borrowed', 'national treasure', 'catch me if you can', 'ex machina', 'juno', 'superbad', 'donnie darko', 'the shinning',
                    'the incredibles', 'the village', 'serendipity', 'inception', 'van helsing', 'the skeleton key', 'black panther', 'avengers',
                    'us', 'toy story', 'lady bird', 'mission: impossible', 'the irishman', 'citizen kane', 'get out', 'spiderman', 'batman', 'robocop',
                    'mad max', 'a star is born', 'casablanca', 'booksmart', 'nosferatu', 'moonlight', 'wonder woman', 'the farewell', 'dunkirk',
                    'inside out', 'modern times', 'roma', 'coco', 'spotlight', 'rubber', 'deadpool', ''];

        foreach ($queries as $query) {

            $this->productSearchService->processSearch($query, 'title');
        }
    }
}
