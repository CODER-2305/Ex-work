                <?
                    $id = $_GET['del'];
                    if ($id) {
                        deletePatient($id);
                        echo "<script>window.location.replace('../?route=dashboard&page=bemor-royxat')</script>";
                    }
                ?>
                <div class="patient_main">
                    <div class="patient_header">
                        <h2 class="patient_title">Bemorlar Ro'yhati</h2>
                        <form action="../components/search.php" method="POST" class="search_form">
                            <div class="search_input">
                                <input class="search" type="search" name="search" placeholder="Bemorlar ichidan izlash...">
                                <span class="search_icon"><i class="fas fa-search"></i></span>
                                <span class="search_cancel"><i class="fas fa-times"></i></span>
                            </div>
                        </form>
                    </div>
                    <div class="patient_body">
                        <div class="delete_submit">
                            <p class="submit_text">Chindan ham "<span>Falonchi</span>" Ma'lumotlarini butkul o'chirmoqchimisiz</p>
                            <a href="#" class="delete_submit_link">Ha</a>
                        </div>
                        <table class="patient_table">
                            <thead class="thead">
                                <tr class="patient_list_title">
                                    <th scope="col">ID</th>
                                    <th scope="col">Ismi</th>
                                    <th scope="col">Familyasi</th>
                                    <th scope="col">Kasal turi</th>
                                    <th scope="col">Yoshi</th>
                                    <th scope="col">Pasport seriya</th>
                                    <th scope="col">Telefon raqami</th>
                                    <th scope="col" class="controls_title">Tahrirlash</th>
                                    <th scope="col" class="controls_title">O'chirish</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            <?for ($i=0; $i < count($patients); $i++):?>
                                <tr class="patient_list">
                                    <th scope="row"><?= $patients[$i]['id']?></th>
                                    <td><a href="../?route=patient-info&id=<?= $patients[$i]['id']?>"><?= $patients[$i]['name']?></a></td>
                                    <td><a href="../?route=patient-info&id=<?= $patients[$i]['id']?>"><?= $patients[$i]['surname']?></a></td>
                                    <td><a href="../?route=patient-info&id=<?= $patients[$i]['id']?>"><?= $patients[$i]['sicktype']?></a></td>
                                    <td><a href="../?route=patient-info&id=<?= $patients[$i]['id']?>"><?= $patients[$i]['age']?></a></td>
                                    <td><a href="../?route=patient-info&id=<?= $patients[$i]['id']?>"><?= $patients[$i]['passport']?></a></td>
                                    <td><a href="../?route=patient-info&id=<?= $patients[$i]['id']?>"><?= $patients[$i]['number']?></a></td>
                                    <td class="table_btn edit_btn"><a href="#"><i class="fas fa-edit"></i></a></td>
                                    <td class="table_btn delete_btn"><a href="../?route=dashboard&page=bemor-royxat&del=<?= $patients[$i]['id']?>"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?endfor;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    const search = document.querySelector('.search'),
                        main = document.querySelector('main'),
                        table = document.querySelector('.patient_table'),
                        tr = document.querySelectorAll('tr'),
                        deleteBtn = document.querySelectorAll('.delete_btn'),
                        deleteSubmit = document.querySelector('.delete_submit'),
                        searchIcon = document.querySelector('.search_icon'),
                        searchForm = document.querySelector('.search_form'),
                        searchCancel = document.querySelector('.search_cancel');
                    
                    search.addEventListener('input',function(){
                        searchCancel.style.display = 'block';
                        if(this.value == ''){
                            searchCancel.style.display = 'none';
                        }
                    });
                    searchCancel.addEventListener('click', function(){
                        search.value = '';
                        this.style.display = 'none';
                    });
                    searchIcon.addEventListener('click', function(){
                        if (search.value.length >= 1) {
                            searchForm.submit();
                        }
                    });
                    let submitClassList = ['submit_text', 'delete_submit'];
                    function isSubmit(e) {
                        for (let i = 0; i < submitClassList.length; i++) {
                            if (e.classList.contains(submitClassList[i])) {
                                return true;
                            }                        
                        }
                    }
                    for (let i = 0; i < deleteBtn.length; i++) {
                        deleteBtn[i].querySelector('a').addEventListener('click', function(e){
                            e.preventDefault();
                        });
                    }
                    document.addEventListener('click', function(e){
                        for (let i = 0; i < deleteBtn.length; i++) { 
                            if (!isSubmit(e.target) && e.target != deleteBtn[i] && e.target != deleteBtn[i].querySelector('i')) {
                                deleteSubmit.classList.remove('active');
                            } else{
                                deleteSubmit.classList.add('active');
                                deleteSubmit.querySelector('a').href = deleteBtn[i].querySelector('a').href;
                                deleteSubmit.querySelector('span').innerHTML = tr[i+1].querySelector('td').querySelector('a').innerHTML;
                                break;
                                
                            }
                        }
                    });
                    // deleteSubmit.querySelector('a').addEventListener('click', function(){
                    //     setTimeout(() => {
                    //         location.reload();
                    //     }, 500);
                    // });
                </script>