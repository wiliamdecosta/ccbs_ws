<?php
/**
 * inquiry
 * class controller for table bds_inquiry
 *
 * @since 23-10-2012 12:07:20
 * @author wiliamdecosta@gmail.com
 */
class p_user_loket_controller extends wbController{

    public static function valid_login($args = array()){

        extract($args);

        $user_name = wbRequest::getVarClean('user_name', 'str', '');
        $password = wbRequest::getVarClean('password', 'str', '');

        try{
            $items = array();
            $table =& wbModule::getModel('paymentccbs', 'p_user_loket');

            $data = array('items' => array(), 'total' => 0, 'success' => false, 'message' => '');
            
            $data['items'] = $table->valid_login($user_name, $password);
            $data['success'] = true;
            $data['total'] = 1;
            $data['message'] = $data['items'];
        }catch(Exception $e){
            $data['message'] = $e->getMessage();
            $data['success'] = false;
        }

        return $data;
    }
}
?>