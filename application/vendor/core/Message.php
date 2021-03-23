<?php

namespace vendor\core;


class Message
{
	const SYSTEM_ERROR = "Terjadi kesalahan sistem";
	const WRONG_USERNAME_PASSWORD = "Username / Password salah";

	const LOGIN_SUCCES = "Login telah berhasil";
	const ALREADY_LOGGED = "Anda masih terdeteksi login. Anda akan dialihkan";
	const INVALID_DATA = "Kami mendeteksi terdapat kejanggalan data";

	const INSERT_SUCCESS = "Data berhasil ditambahkan";
	const UPDATE_SUCCESS = "Data berhasil diubah";
	const DELETE_SUCCESS = "Data berhasil dihapus";

	const VALIDATION_REQUIRED = "Field %s tidak boleh kosong";
	const VALIDATION_MAXLENGTH = "Field %s tidak boleh lebih dari %d karakter";
	const VALIDATION_DATE = "Field %s bukan tanggal";
	const VALIDATION_INTEGER = "Field %s hanya boleh menggunakan nomor";
	const VALIDATION_EMAIL = "Field %s tidak sesuai format email";
	const VALIDATION_UNIQUE = "{field} %s sudah pernah digunakan. Gunakan {field} yang lain";

	const INFO_RECYCLE = "Button ini akan menampilkan data yang sudah dihapus";

    const TITLE_CONFIRM_SAVE =  "Save confirmation";
    const TITLE_CONFIRM_UPDATE =  "Update confirmation";
    const TITLE_CONFIRM_DELETE =  "Delete confirmation";

    const SPARE_PART_NOT_FOUND = "We can't find your Spare Part. Do You want to add? ";

	const NOTIF_ADD_SCHEDULE = "Tanggal %s anda dijadwalkan oleh %s : %s";
	const NOTIF_UPDATE_SCHEDULE = "Jadwal anda %s diperbarui oleh %s : %s";
}
