<?php
/**
 * inquiry
 * class controller for table bds_inquiry
 *
 * @since 23-10-2012 12:07:20
 * @author wiliamdecosta@gmail.com
 */
class payment_controller extends wbController{

    public static function read($args = array()){

        extract($args);

        $page = wbRequest::getVarClean('current', 'int', 1);
        $limit = wbRequest::getVarClean('rowCount', 'int', 10);

        $sort = wbRequest::getVarClean('sortby', 'str', '');
        $dir = wbRequest::getVarClean('sortdir', 'str', 'ASC');
        $searchPhrase = wbRequest::getVarClean('searchPhrase', 'str', '');

        $data = array('items' => array(), 'total' => 0, 'success' => false, 'message' => '');
        $start = ($page-1) * $limit;

        try{
            $table =& wbModule::getModel('paymentccbs', 'payment');
            if(!empty($searchPhrase)) {
                $table->setCriteria("UPPER(CODE) LIKE ?", array('%'.strtoupper($searchPhrase).'%'));
            }

            $items = $table->getAll($start, $limit, $sort, $dir);
            $total = $table->countAll();
            
            
            $data['items'] = $items;
            $data['total'] = $total;
            $data['current'] = $page;
            $data['rowCount'] = $limit;
    
            $data['message'] = '';
            $data['success'] = true;
        
        }catch(Exception $e){
            $data['message'] = $e->getMessage();
            $data['success'] = false;
        }

        
        return $data;
    }


    public static function stp_pay_acc($args = array()){

        extract($args);

        $page = wbRequest::getVarClean('current', 'int', 1);
        $limit = wbRequest::getVarClean('rowCount', 'int', 10);

        $sort = wbRequest::getVarClean('sortby', 'str', '');
        $dir = wbRequest::getVarClean('sortdir', 'str', 'ASC');
        $searchPhrase = wbRequest::getVarClean('searchPhrase', 'str', '');
        
        /* post params */
        $service_no = wbRequest::getVarClean('service_no', 'str', '');
        $action = wbRequest::getVarClean('action', 'str', 'query');
        $i_id = wbRequest::getVarClean('i_id', 'str', '');

        $data = array('items' => array(), 'total' => 0, 'success' => false, 'message' => '');
        $start = ($page-1) * $limit;

        try{
            $items = array();
            $table =& wbModule::getModel('paymentccbs', 'payment');
            
            $table->dbconn->fetchMode = PGSQL_NUM;
            $query = "SELECT * FROM ifp.f_pay_acc(?,?,?,?,?)";
            $result =& $table->dbconn->Execute($query, array($service_no, $action, $start, $limit, $i_id));
            
            $rows = $result->fields;
            
            if( isset ($rows['cnt']) ) {
                //if( $rows['cnt'] == 0 ) {
                //    $data['items'] = array();
                //}else {
                    $data['items'] = array($rows);    
                //}
                $data['total'] = $rows['cnt']; 
                $data['message'] = $rows['msg'];
            }else {
                $data['items'] = $rows;
                $data['total'] = $rows[0]['cnt']; 
                $data['message'] = $rows[0]['msg'];
            }
                    	
            $data['current'] = $page;
            $data['rowCount'] = $limit;
            $data['success'] = true;

        }catch(Exception $e){
            $data['message'] = $e->getMessage();
            $data['success'] = false;
        }

        return $data;
    }
}
?>