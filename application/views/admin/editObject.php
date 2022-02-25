<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/editObject/<?php echo $data['id']; ?>" method="post" >
                            <div class="form-group">
                                <label>Дата</label>
                                <input class="form-control" type="date" name="date" value="<?php echo htmlspecialchars($data['date'], ENT_QUOTES); ?>">
                            </div> 
                            <div class="form-group">
                                <label>Тип экспоната</label>
                                <select class="form-control" name="type">
                                    <option selected value="">Выбрать</option>
                                    <option value="1">Радиотехника и телевидение</option>
                                    <option value="2">Автоматика и ВТ</option>
                                    <option value="3">Авиация и космонавтика</option>
                                    <option value="4">Электроника и ИБ</option>
                                </select>
                            </div>   
                            <div class="form-group">
                                <label>Название</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['description'], ENT_QUOTES); ?>" name="description">
                            </div>
                            <div class="form-group">
                                <label>Текст</label>
                                <textarea class="form-control" rows="3" name="text"><?php echo htmlspecialchars($data['text'], ENT_QUOTES); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Изображение</label>
                                <input class="form-control" type="file" name="img">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>