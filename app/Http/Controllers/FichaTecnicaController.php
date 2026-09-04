namespace App\Http\Controllers;
use App\Models\FichaTecnica;
use App\Models\Sofa;
use Illuminate\Http\Request;

class FichaTecnicaController extends Controller
{
    public function index(Request $request) {
        $busca = $request->input('busca');
        
        // Busca funcional e carregamento do relacionamento
        $fichas = FichaTecnica::with('sofa')
            ->when($busca, function($query, $busca) {
                // Busca pelo nome do modelo do sofá relacionado ou pelo tecido
                $query->whereHas('sofa', function($q) use ($busca) {
                    $q->where('modelo', 'like', "%{$busca}%");
                })->orWhere('tecido', 'like', "%{$busca}%");
            })->get();

        return view('fichas.index', compact('fichas', 'busca'));
    }

    public function create() {
        // Para 1:1, buscar apenas Sofás que AINDA NÃO TEM ficha técnica
        $sofas = Sofa::doesntHave('fichaTecnica')->get(); 
        return view('fichas.create', compact('sofas'));
    }

    public function store(Request $request) {
        // Validação dos dados (Requisito 5)
        $request->validate([
            'sofa_id' => 'required|exists:sofas,id|unique:ficha_tecnicas,sofa_id',
            'tecido' => 'required|string|max:255',
            'peso' => 'required|numeric|min:1',
        ]);

        FichaTecnica::create($request->all());
        return redirect()->route('fichas.index')->with('success', 'Ficha salva com sucesso!');
    }
    
    // Implemente edit(), update() e destroy() seguindo a mesma lógica.
}