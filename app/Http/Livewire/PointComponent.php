<?php

namespace App\Http\Livewire;


use App\Models\Eleve;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PointComponent extends Component
{
	use WithPagination;
	protected $paginationTheme ='bootstrap';
	public $evaluation_id ;
	public $evaluation;

	public $search;
	public $points=[];
	public string $orderField = 'first_name';
	public string $orderDirection = 'ASC';
	public int $editId = 0;

	protected $queryString = [
		'search' => ['except' => '']

	];

	public function startId(int $id){
		$this->editId = $id;
	}

	public function setOrderBy(string $name){

		if($this->orderField == $name){
			$this->orderDirection = $this->orderDirection == 'ASC' ? 'DESC' : 'ASC';
		}else{
			$this->orderField = $name;
			$this->orderDirection = 'ASC';
		}

	}


	public function mount(Request $request){
		$this->evaluation_id = $request->id;
		$this->evaluation = Evaluation::where('id','=',$request->id)->firstOrFail();

	}
    public function render()
    {
    	$eleves = Eleve::where('classe_id','=',$this->evaluation->classe_id )->where('anne_scolaire_id','=',$this->evaluation->anne_scolaire_id )
		->where('first_name','LIKE','%'.$this->search.'%')
		->orderBy($this->orderField, $this->orderDirection)->paginate();
    	
        return view('livewire.point-component',[
        	'eleves' => $eleves

        ]);
    }
}
