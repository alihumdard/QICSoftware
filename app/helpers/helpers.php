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
            return 'Admin';
        case 2:
            return 'Client';
        case 3:
            return 'Driver';
        default:
            return false;
    }    
}

function auth_users(){
    // status : 1 for active , 2 for pending, 3 for suspended , 4 for unverified ,5 for delete ...
    $user_status =  [1, 2];
    return $user_status;   
}

function user_role_no($role_no){
    switch ($role_no) {
        case 'Admin':
            return 1;
        case 'Client':
            return 2;
        case 'Driver':
            return 3 ;
        default:
            return false;
    }    
}

function view_permission($page_name) {
    $user_role = session('user_details')->role;
    switch ($user_role) {
        
        case 'Admin':
            switch ($page_name) {
                case 'index':
                case 'settings':
                case 'clients':
                case 'drivers':
                // case 'calender':
                case 'routes':    
                case 'users':
                // case 'announcements':
                // case 'notifications': 
                case 'create_trip':     
            // case 'announcements_alerts': 
                // case 'pdf_templates': 
                // case 'packages': 
                case 'logout': 
                // case 'calendar_maintable': 

                    return true;
                default:
                    return false;
            }

        case 'Client':
            switch ($page_name) {
                case 'index':
                case 'settings':
                case 'drivers':
                case 'routes':
                // case 'calender':      
                // case 'notifications':    
                case 'create_trip': 
                case 'logout': 
                // case 'home': 
                // case 'subscription':
                // case 'calendar_maintable': 

                    return true;
                default:
                    return false;
            }

        case 'Driver':
            switch ($page_name) {
                case 'index':
                case 'settings':    
                case 'routes': 
                case 'create_trip': 
                // case 'calender':    
                // case 'notifications':    
                // case 'driver_map':    
                case 'logout':
                // case 'calendar_maintable':
                    return true;
                    
                default:
                    return false;
            }

        default:
            return false;
    }
}


?>