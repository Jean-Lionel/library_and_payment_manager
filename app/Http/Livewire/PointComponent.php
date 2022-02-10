<?php

namespace App\Http\Livewire;


use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\PointEvaluation;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use DB;

class PointComponent extends Component
{
	use WithPagination;
	protected $paginationTheme ='bootstrap';
	public $evaluation_id ;
	public $classe_id ;
	public $evaluation;
	public $point_obentu;
	public $courId;
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
		"point_obentu" => 'required|min:0',
		
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
		$this->classe_id = $this->evaluation->classe_id;
		
	}
	public function savePoint(){

		$this->validate();
		$check = PointEvaluation::where('evaluation_id', '=', $this->evaluation_id)
		->where('eleve_id' ,'=',$this->editId)
		->first();

		if($this->point_obentu <= $this->evaluation->ponderation){
			//dd($this->evaluation->cour_id);

			$data = [
				'evaluation_id' => $this->evaluation_id,
				'eleve_id' => $this->editId,
				'point_obtenu' => $this->point_obentu,
				'cour_id' => $this->courId,
				'classe_id' => $this->classe_id,
				'type_evaluation' => $this->evaluation->type_evaluation,
				'ponderation' => $this->evaluation->ponderation,
				'trimestre_id' => $this->evaluation->trimestre,
				'anne_scolaire_id' => $this->evaluation->anne_scolaire_id,
			];

			//$res = PointEvaluation::create(); 

			// dd($data);

			if($check){
				$check->update(	$data);
			}else{
				PointEvaluation::create($data);
			}

		}
		$this->point_obentu = "";
		$this->editId = 0;
	}
	public function render()
	{
		$this->courId = $this->evaluation->cour_id;
		$eleves = 
		Eleve::where('classe_id','=',$this->evaluation->classe_id )
		->where('anne_scolaire_id','=',$this->evaluation->anne_scolaire_id )
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
				'ponderation' => $this->evaluation->ponderation,
			]

		]);
	}

	public function closeForm(){
		$this->editId = 0;
	}

	public function testExemple($data){

		try {
			DB::beginTransaction();
			foreach($data as $entry){
			//VERFICATION QUE LA LIGNE N'EXISTE PAS 

				if(isset($entry['evaluation_id']) and isset($entry['eleve_id'])){

					$check = PointEvaluation::where('evaluation_id', '=',
						$entry['evaluation_id'])->where('eleve_id' ,'=',$entry['eleve_id'])->first();
				// Vérification des points
					$metaData =  [
						'cour_id' => $this->evaluation->cour_id,
						'classe_id' => $this->classe_id,
						'trimestre_id' => $this->evaluation->trimestre,
						'anne_scolaire_id' => $this->evaluation->anne_scolaire_id,
						'type_evaluation' => $this->evaluation->type_evaluation,
						'ponderation' => $this->evaluation->ponderation,
					];

					if (isset($entry['point_obtenu']) and is_numeric($entry['point_obtenu']) and $entry['point_obtenu'] <= $this->evaluation->ponderation ) {
					// code...
					//dd($entry['point_obtenu']);
						$entry = array_merge($entry,$metaData);
						
					}else{
						$entry['point_obtenu'] = NULL;
					}
					if($check){
						$check->update($entry);
					}else{
						PointEvaluation::create($entry);
					}

				}
				

			}
			DB::commit();
			
		} catch (\Exception $e) {
			dd($e->getMessage());
			DB::rollback();
			
		}
	}
}
