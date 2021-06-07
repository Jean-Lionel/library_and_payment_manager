<?php

namespace App\Http\Livewire;


use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\PointEvaluation;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PointComponent extends Component
{
	use WithPagination;
	protected $paginationTheme ='bootstrap';
	public $evaluation_id ;
	public $evaluation;
	public $point_obentu;

	public $search;
	public $points=[];
	public string $orderField = 'first_name';
	public string $orderDirection = 'ASC';
	public int $editId = 0;

	public function postAdded(){
		$this->emit('postAdded');
	}


	protected $queryString = [
		'search' => ['except' => '']
	];
	protected $rules = [
		"point_obentu" => 'required|min:0'
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
	public function savePoint(){

		$this->validate();
		$check = PointEvaluation::where('evaluation_id', '=', $this->evaluation_id)
								  ->where('eleve_id' ,'=',$this->editId)
								  ->first();

		if($this->point_obentu < $this->evaluation->ponderation){
			//dd($this->point_obentu);

			$res = PointEvaluation::create([
					'evaluation_id' => $this->evaluation_id,
					'eleve_id' => $this->editId,
					'point_obtenu' => $this->point_obentu,
				]); 

			if($check){
				$check->update([
					'evaluation_id' => $this->evaluation_id,
					'eleve_id' => $this->editId,
					'point_obtenu' => $this->point_obentu,
				]);
			}else{
				PointEvaluation::create([
					'evaluation_id' => $this->evaluation_id,
					'eleve_id' => $this->editId,
					'point_obtenu' => $this->point_obentu,
				]);
			}

		}
		$this->point_obentu = "";
		$this->editId = 0;
	}
    public function render()
    {
    	$eleves = Eleve::where('classe_id','=',$this->evaluation->classe_id )->where('anne_scolaire_id','=',$this->evaluation->anne_scolaire_id )
		->where('first_name','LIKE','%'.$this->search.'%')
		->orderBy($this->orderField, $this->orderDirection)->paginate();

		$tout_eleves = Eleve::where('classe_id','=',$this->evaluation->classe_id )->where('anne_scolaire_id','=',$this->evaluation->anne_scolaire_id )
		->where('first_name','LIKE','%'.$this->search.'%')
		->orderBy($this->orderField, $this->orderDirection)->get();
    	
        return view('livewire.point-component',[
        	'eleves' => $eleves,
        	'tout_eleves' =>  $tout_eleves,
        	'info' =>[
        		'classe_name' => $this->evaluation->classe->name,
        		'cour_name' => $this->evaluation->cour->name,
        		'date_evaluation' => $this->evaluation->date_evaluation,
        	]

        ]);
    }

    public function closeForm(){
    	$this->editId = 0;
    }

    public function testExemple($data){

		foreach($data as $entry){
			//VERFICATION QUE LA LIGNE N'EXISTE PAS 

			if(isset($entry['evaluation_id']) and isset($entry['eleve_id'])){
				$check = PointEvaluation::where('evaluation_id', '=',
				 $entry['evaluation_id'])->where('eleve_id' ,'=',$entry['eleve_id'])->first();
				if($check){
					$check->update($entry);
				}else{
					PointEvaluation::create($entry);
				}

			}
			

		}
    }
}
