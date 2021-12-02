<?php 

class response {
    public $title;
    public $content;
    function __construct($title=null, $content=null){
        $this->content = $content;
        $this->title = $title;
    }
    public function send($code, $json = null){
        if(is_null($json))
            echo json_encode(["data" => $this, "code" => $code], JSON_UNESCAPED_UNICODE);
        else
            echo json_encode(["data" => $json, "code" => $code], JSON_UNESCAPED_UNICODE);
        die();
    }
}

class TA {
    private $con;

    public $studentId;
    public $name;
    public $email;
    public $aboutMe;
    public $img;
    public $mobile;
    public $password;
    public function __construct($db, $email, $sutdentId = null, $name = null,  $aboutMe = null, $mobile = null, $password = null, $img = null){
        $this->studentId = $sutdentId;
        $this->name = $name;
        $this->email = $email;
        $this->aboutMe = $aboutMe;
        $this->img = $img;
        $this->mobile = $mobile;
        $this->password = $password;
        $this->con = $db;
    }
    public function get(){
        $s_email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $stmt = $this->con->prepare('select * from TA where email = ?');
        $stmt->bind_param('s', $s_email);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 1){
            $TA = $res->fetch_assoc();
            $this->studentId = $TA['studentId'];
            $this->name = $TA['name'];
            $this->aboutMe = $TA['aboutMe'];
            $this->img = $TA['img'];
            $this->mobile = $TA['mobile'];
            $this->password = $TA['password'];
            return true;      
        }else  
            return false;
    }
    
    public function create(){      
        if($this->get()){
            $response = new response('خطای ثبت اطلاعات', 'قبلا شخصی با این ایمیل ثبت نام کرده است.');
            $response->send(0);
        }
        $s_email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $s_studentId = filter_var($this->studentId, FILTER_SANITIZE_STRING);
        $s_name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $s_aboutMe = filter_var($this->aboutMe, FILTER_SANITIZE_STRING);
        $s_mobile = filter_var($this->mobile, FILTER_SANITIZE_STRING);
        $s_password = filter_var($this->password, FILTER_SANITIZE_STRING);

        $stmnt = $this->con->prepare("insert into TA (studentId, name, email, aboutMe, mobile, password) values (?,?,?,?,?,?)");
        $stmnt->bind_param('ssssss', $s_studentId, $s_name, $s_email, $s_aboutMe, $s_mobile, $s_password);
        $stmnt->execute();
        if($this->con->error){
            $response = new response('خطای ثبت اطلاعات', 'مشکل کوپری');
            $response->send(0);
        }
    }
    public function update($ta){
        $s_email = filter_var($ta->email, FILTER_SANITIZE_EMAIL);
        $s_studentId = filter_var($ta->studentId, FILTER_SANITIZE_STRING);
        $s_name = filter_var($ta->name, FILTER_SANITIZE_STRING);
        $s_aboutMe = filter_var($ta->aboutMe, FILTER_SANITIZE_STRING);
        $s_mobile = filter_var($ta->mobile, FILTER_SANITIZE_STRING);
        $s_password = filter_var($ta->password, FILTER_SANITIZE_STRING);

        $prevEmail = $this->email;

        $this->email = (!empty($s_email)) ? $s_email : $this->email;
        $this->studentId = (!empty($s_studentId)) ? $s_studentId : $this->studentId;
        $this->name = (!empty($s_name)) ? $s_name : $this->name;
        $this->aboutMe = (!empty($s_aboutMe)) ? $s_aboutMe : $this->aboutMe;
        $this->mobile = (!empty($s_mobile)) ? $s_mobile : $this->mobile;
        $this->password = (!empty($s_password)) ? $s_password : $this->password;

        $stmnt = $this->con->prepare("update TA set email=?, studentId=?, name=?, aboutMe=?, mobile=?, password=? where email=?");
        $stmnt->bind_param("sssssss", $this->email, $this->studentId, $this->name, $this->aboutMe, $this->mobile, $this->password, $prevEmail);
        $stmnt->execute();
        if($this->con->error){
            $response = new response('خطای اپدیت اطلاعات', 'مشکل کوپری');
            $response->send(0);
        }
    }
}