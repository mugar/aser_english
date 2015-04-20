<?php
class TracesController extends AppController {

	var $name = 'Traces';

	function index($id,$model) {
		$this->paginate['order']=array('Trace.id asc');
		$traces=$this->paginate(array('Trace.model_id'=>$id,
									'Trace.model'=>$model,
									)
							);
		$referer=$this->referer();
		$this->set(compact('traces','model','id','referer'));
	}
}
?>