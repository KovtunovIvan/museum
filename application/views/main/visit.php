<header class="masthead" style="background-image: url('/public/images/contact-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Таганрогский<br>политехнический музей</h1>
                    <span class="subheading">Записаться в музей</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="/visit" method="post">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" name="name" placeholder="Имя"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input type="text" class="form-control" name="email" placeholder="E-mail"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><input name="date" type="datetime-local" class="form-control"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <p><textarea rows="5" class="form-control" name="text" placeholder="Комментарий"></textarea></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary" id="sendMessageButton">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>