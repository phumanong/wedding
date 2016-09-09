<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
                <div class="center">
                    <h1>
                        <i class="ace-icon fa fa-leaf green"></i>
                        <span class="red">Ace</span>
                        <span class="white" id="id-text2">Application</span>
                    </h1>
                    <h4 class="blue" id="id-company-text">&copy; Edenplaza</h4>
                </div>

                <div class="space-6"></div>

                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header blue lighter bigger">
                                    <i class="ace-icon fa fa-coffee green"></i>
                                    Vui lòng điền thông tin
                                </h4>

                                <div class="space-6"></div>

                                <form>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập" autocomplete="off"/ />
                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>

                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu" autocomplete="off"//>
                                                <i class="ace-icon fa fa-lock"></i>
                                            </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">
                                            <label class="inline">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"> Remember Me</span>
                                            </label>

                                            <button type="button" id="login" class="width-35 pull-right btn btn-sm btn-primary">
                                                <i class="ace-icon fa fa-key"></i>
                                                <span class="bigger-110">Login</span>
                                            </button>
                                        </div>

                                        <div class="space-4"></div>
                                    </fieldset>
                                </form>
                            </div><!-- /.widget-main -->

                            <div class="toolbar clearfix">
                                <div>
                                    <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        Quên mật khẩu
                                    </a>
                                </div>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.login-box -->

                    <div id="forgot-box" class="forgot-box widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header red lighter bigger">
                                    <i class="ace-icon fa fa-key"></i>
                                    Lấy lại mật khẩu
                                </h4>

                                <div class="space-6"></div>
                                <p>
                                    Vui lòng điền email 
                                </p>

                                <form>
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" class="form-control" placeholder="Email" />
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>

                                        <div class="clearfix">
                                            <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                <i class="ace-icon fa fa-lightbulb-o"></i>
                                                <span class="bigger-110">Send Me!</span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!-- /.widget-main -->

                            <div class="toolbar center">
                                <a href="#" data-target="#login-box" class="back-to-login-link">
                                    Trở lại trang login
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.forgot-box -->
                </div><!-- /.position-relative -->

                <div class="navbar-fixed-top align-right">
                    <br />
                    &nbsp;
                    <a id="btn-login-dark" href="#">Dark</a>
                    &nbsp;
                    <span class="blue">/</span>
                    &nbsp;
                    <a id="btn-login-blur" href="#">Blur</a>
                    &nbsp;
                    <span class="blue">/</span>
                    &nbsp;
                    <a id="btn-login-light" href="#">Light</a>
                    &nbsp; &nbsp; &nbsp;
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login').click(function(){
            Login();
        });
    });
    function Login() {
        var username = $("#username").val();
        var password = $('#password').val();
        $.ajax({
            type: "POST",
            data: {
                'username': username,
                'password': password,
            },
            url: "<?= Url::to(['site/login']) ?>",
            success: function (result) {
                console.log(result);
                if(result == 'success')
                {
                    window.location.href = '<?= Url::to(['site/index']) ?>';
                }
            }
        })
    }
</script>
