<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Curation;

class HomeController extends Controller
{
    public function index()
    {
        return view('toppage', [
            'categories' => Category::all(),
            'recentPosts' => Post::latest()->take(3)->get(),
            'curations' => Curation::all(),
            'ranking' => Post::orderBy('views', 'desc')->take(2)->get(),
        ]);
    }
}
