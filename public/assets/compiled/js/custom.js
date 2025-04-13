// sidebar active
document.addEventListener("DOMContentLoaded", function() { 
    var submenuItems = document.querySelectorAll('.submenu-item a');
    var sidebarItems = document.querySelectorAll('.sidebar-item a');
    var currentURL = window.location.pathname;

    submenuItems.forEach(function(item) {
        if (currentURL.startsWith(item.getAttribute('href'))) {
            item.parentElement.classList.add('active');
            var parentSidebarItem = item.closest('.has-sub');
            if (parentSidebarItem) {
                parentSidebarItem.classList.add('active');
            }
        } else {
            item.parentElement.classList.remove('active');
        }
    });

    sidebarItems.forEach(function(item) {
        item.addEventListener('click', function() {
            sidebarItems.forEach(function(innerItem) {
                innerItem.parentElement.classList.remove('active');
            });
            
            item.parentElement.classList.add('active');
        });
    });
});
// sidebar active ends

// DataTables Buttons
$(document).ready(function() {
    $('#datatables-buttons').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(.no-export)' 
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(.no-export)' 
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            }
        ]
    });
});
// DataTables Buttons Ends

// id pakai choices
$(document).ready(function() {
    console.log('Inisialisasi Choices.js dimulai');
    const choices = new Choices('.choices', {
        removeItemButton: true,
        placeholder: true,     
        searchEnabled: true,    
        itemSelectText: '',      
    });

    const choices2 = new Choices('.choices2', {
        removeItemButton: true, 
        placeholder: true,       
        searchEnabled: true,     
        itemSelectText: '',      
    });
});
// id pakai choices end

// choices untuk buku
$(document).ready(function() {
    console.log('Inisialisasi Choices.js dimulai');
    
    const choices = new Choices('.buku_id', {
        removeItemButton: true,  
        placeholder: true,       
        searchEnabled: true,     
        itemSelectText: '',      
    });

    $('#add-book-btn').click(function() {
        var newBookEntry = $('#book-entry-template').html();
        $('#book-list').append(newBookEntry);

        const newSelectElement = $('#book-list .buku_id:last');
        
        if (newSelectElement.length > 0) {
            const newChoices = new Choices(newSelectElement[0], {
                removeItemButton: true,
                placeholder: true,
                searchEnabled: true,
                itemSelectText: '',
            });

            $('#book-list .book-entry:last .delete-book').click(function() {
                $(this).closest('.book-entry').remove();
            });
        } else {
            console.log('Tidak ada buku yang dapat dipilih');
        }

        setTimeout(() => {
            newChoices.setChoiceByValue('');
        }, 100);
    });
});
// choices untuk buku end

// untuk menghitung tanggal pinjam dan kembali
$(document).ready(function() {  
    // Fungsi untuk mendapatkan tanggal hari ini  
    function getTodayDate() {  
        var today = new Date();  
        var dd = String(today.getDate()).padStart(2, '0');  
        var mm = String(today.getMonth() + 1).padStart(2, '0');  
        var yyyy = today.getFullYear();  
        return yyyy + '-' + mm + '-' + dd;  
    }  

    // Mengatur nilai tanggal peminjaman dengan tanggal hari ini  
    $('#tgl_pinjam').val(getTodayDate());  

    // Fungsi untuk menghitung tanggal kembali  
    function hitungTanggalKembali() {  
        var tglPinjam = new Date($('#tgl_pinjam').val());  
        var durasi = parseInt($('#durasi_pinjam').val());  

        // Jika durasi dipilih, hitung tanggal kembali  
        if (!isNaN(durasi)) {  
            var tglKembali = new Date(tglPinjam);  
            tglKembali.setDate(tglKembali.getDate() + durasi); // Tambah durasi ke tanggal peminjaman  

            // Format tanggal kembali ke format yang diinginkan (yyyy-mm-dd)  
            var dd = String(tglKembali.getDate()).padStart(2, '0');  
            var mm = String(tglKembali.getMonth() + 1).padStart(2, '0');  
            var yyyy = tglKembali.getFullYear();  

            $('#tgl_kembali').val(yyyy + '-' + mm + '-' + dd); // Set tanggal kembali  
        }  
    }  

    hitungTanggalKembali(); // Hitung tanggal kembali saat dokumen siap  
    $('#durasi_pinjam').change(hitungTanggalKembali); // Hitung tanggal kembali saat durasi diubah  
    $('#tgl_pinjam').change(hitungTanggalKembali); // Hitung tanggal kembali saat tgl pinjam diubah  
});
// untuk menghitung tanggal pinjam dan kembali

function initializeEditPeminjaman() {
    function hitungTanggalKembali() {
        var tglPinjam = new Date($('#tgl_pinjam').val());
        var durasi = parseInt($('#durasi_pinjam').val());
        var tglKembali = new Date(tglPinjam.getTime() + (durasi * 24 * 60 * 60 * 1000));
        
        var dd = String(tglKembali.getDate()).padStart(2, '0');
        var mm = String(tglKembali.getMonth() + 1).padStart(2, '0');
        var yyyy = tglKembali.getFullYear();
        
        $('#tgl_kembali').val(yyyy + '-' + mm + '-' + dd);
    }

    $('#durasi_pinjam').change(hitungTanggalKembali);
    $('#tgl_pinjam').change(hitungTanggalKembali);

    $('#editPeminjamanForm').on('submit', function(e) {
        e.preventDefault();
        
        $('.buku_id').filter(function() {
            return !this.value;
        }).closest('.mb-3').remove();

        if ($('.buku_id').filter(function() { return this.value; }).length === 0) {
            alert('Pilih setidaknya satu buku');
            return;
        }

        this.submit();
    });
}

$(document).ready(function() {
    if ($('#editPeminjamanForm').length) {
        initializeEditPeminjaman();
    }
});


// <-- auto generate ID-->
$(document).ready(function() {
    function generateIDPSiswa() {
        const prefix = 'PSS-';
        const date = new Date();
        const year = date.getFullYear(); 
        const day = String(date.getDate()).padStart(2, '0'); 
        const dateKey = `${year}${day}-PSS`;
        
        let counter = localStorage.getItem(dateKey) ? parseInt(localStorage.getItem(dateKey)) : 0;
        counter += 1;
        
        localStorage.setItem(dateKey, counter);
        
        const generatedID = `${prefix}${year}${day}-${String(counter).padStart(3, '0')}`;
        
        const siswaPInput = document.querySelector('#id_peminjaman.id_peminjamanSiswa');
        if (siswaPInput) {
            siswaPInput.value = generatedID;
        }
    }

    function generateIDPGuru() {
        const prefix = 'PG-';
        const date = new Date();
        const year = date.getFullYear(); 
        const day = String(date.getDate()).padStart(2, '0'); 
        const dateKey = `${year}${day}`;
        
        let counter = localStorage.getItem(dateKey) ? parseInt(localStorage.getItem(dateKey)) : 0;
        counter += 1;
        
        localStorage.setItem(dateKey, counter);
        
        const generatedID = `${prefix}${year}${day}-${String(counter).padStart(3, '0')}`;
        
        const guruInput = document.querySelector('#id_peminjaman.id_peminjamanGuru');
        if (guruInput) {
            guruInput.value = generatedID;
        }
    }
    

    function generateIDPKelas() {
        const prefix = 'PK-';
        const date = new Date();
        const year = date.getFullYear();
        const day = String(date.getDate()).padStart(2, '0');
        const dateKey = `${year}${day}-PK`; // Menambahkan identifier 'PK' pada key
        
        let counter = localStorage.getItem(dateKey) ? parseInt(localStorage.getItem(dateKey)) : 0;
        counter += 1;
        
        localStorage.setItem(dateKey, counter);
        
        const generatedID = `${prefix}${year}${day}-${String(counter).padStart(3, '0')}`;
        
        const kelasInput = document.querySelector('#id_peminjaman.id_peminjamanKelas');
        if (kelasInput) {
            kelasInput.value = generatedID;
        }
    }
    
    

    function generateIDKSiswa() {
        const prefix = 'KS-';
        const date = new Date();
        const year = date.getFullYear();
        const day = String(date.getDate()).padStart(2, '0');
        const dateKey = `${year}${day}-KS`;
        
        let counter = localStorage.getItem(dateKey) ? parseInt(localStorage.getItem(dateKey)) : 0;
        counter += 1;
        
        localStorage.setItem(dateKey, counter);
        
        const generatedIDSiswa = `${prefix}${year}${day}-${String(counter).padStart(3, '0')}`;
        
        const siswaInput = document.querySelector('#id_kunjungan.id_kunjunganSiswa');
        if (siswaInput) {
            siswaInput.value = generatedIDSiswa;
        }
    }
    

    function generateIDKGuru() {
        const prefix = 'KG-';
        const date = new Date();
        const year = date.getFullYear();
        const day = String(date.getDate()).padStart(2, '0');
        const dateKey = `${year}${day}-KG`;
        
        let counter = localStorage.getItem(dateKey) ? parseInt(localStorage.getItem(dateKey)) : 0;
        counter += 1;
        
        localStorage.setItem(dateKey, counter);
        
        const generatedIDGuru = `${prefix}${year}${day}-${String(counter).padStart(3, '0')}`;
        
        const guruInput = document.querySelector('#id_kunjungan.id_kunjunganGuru');
        if (guruInput) {
            guruInput.value = generatedIDGuru;
        }
    }
    
    generateIDPSiswa();
    generateIDPGuru();
    generateIDPKelas();
    generateIDKSiswa();
    generateIDKGuru();
});
// <-- auto generate ID end-->

// Inisialisasi Parsley untuk form
$('form').parsley();


