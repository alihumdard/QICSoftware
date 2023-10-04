<?php
function table_date($datetime){
    $date = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z',$datetime);
    if ($date instanceof DateTime) {
        return $date->format('M d, Y');
    } else {
        return 'Invalid datetime';
    }
}

function end_url(){
    return url('/api').'/';
}

function user_roles($role_no){
    switch ($role_no) {
        case 1:
            return 'Super Admin';
        case 2:
            return 'Admin';
        case 3:
            return 'User';
        default:
            return false;
    }    
}

function auth_users(){
    // status : 1 for active , 2 for pending, 3 for suspended , 4 for unverified ,5 for delete ...
    $user_status =  [1, 2];
    return $user_status;   
}

function active_users(){
    // status : 1 for active , 2 for pending, 3 for suspended , 4 for unverified ,5 for delete ...
    $user_status =  [1];
    return $user_status;   
}

function user_role_no($role_no){
    switch ($role_no) {
        case 'Super Admin':
            return 1;
        case 'Admin':
            return 2;
        case 'User':
            return 3 ;
        default:
            return false;
    }    
}

function view_permission($page_name) {
    $user_role = session('user_details')->role;
    switch ($user_role) {
        
        case 'Super Admin':
            switch ($page_name) {
                case 'index':
                case 'settings':
                case 'quotations':
                case 'invoices':
                case 'admins':
                case 'users':
                case 'add_quotation':
                case 'add_contract':
                case 'add_invoice':
                case 'contracts':
                case 'super_admins': 
                case 'logout': 
                case 'currencies': 
                case 'revenue': 
                    return true;
                default:
                    return false;
            }

        case 'Admin':
            switch ($page_name) {
                case 'index':
                case 'settings':
                case 'quotations':
                case 'invoices':
                case 'users':
                case 'add_quotation':
                case 'add_contract':
                case 'add_invoice':
                case 'contracts':
                case 'logout': 
                    return true;
                default:
                    return false;
            }

        case 'User':
            switch ($page_name) {
                case 'index':
                case 'settings':
                case 'quotations':
                case 'invoices':
                case 'add_quotation':
                case 'add_invoice':
                case 'add_contract':
                case 'contracts':    
                case 'logout':
                    return true;
                    
                default:
                    return false;
            }

        default:
            return false;
    }
}


?>