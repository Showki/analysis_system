<?php
class ProblemComparesController extends AppController{
	public $name = "ProblemCompares";
	public $uses = array('Evaluate');

	public function index(){
		$this->redirect('problem_show');
	}

	public function question($value='')
	{
		# code...
	}

}
?>
