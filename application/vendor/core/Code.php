<?php

namespace vendor\core;

class Code
{

	const RESULT_OK = "OK";
	const RESULT_ERROR = "ERROR";

	const TYPE_ERROR = "error";
	const TYPE_OK = "success";

	const PAGE_NOT_FOUND = 400;
	const INTERNAL_ERROR = 500;
	const CODE_AUTHENTICATED = 200;
	const VALIDATION_ERROR = 801;

	const AUTHGUEST = "guest";
	const AUTHENTICATED = "authenticated";

	const SESSION_USERID = "SESS_USERID";
	const SESSION_FULLNAME = "SESS_FULLNAME";
	const SESSION_ROLEID = "SESS_ROLEID";
	const SESSION_ROLENM = "SESS_ROLENM";

	const TYPE_SURAT_JALAN = 197;

	const TRANS_GOODS_RECEIPTS  = "GOODS_RECEIPTS";
	const TRANS_DELIVERY_ORDER  = "DELIVER_ORDER";
	const TRANS_MUTATION_OUT    = "MUTATION_OUT";
	const TRANS_PURCHASE_RETURN = "PURCHASE_RETURN";
	const TRANS_SURAT_JALAN = "SURAT_JALAN";

	const OMZET_BY_MONTH = 'obymonth';
	const OMZET_BY_SUPDIS = 'obysupdis';

	const STATUS_AKAN_DILAKSANAKAN = 25;

	const STATUS_UFHD_OPEN = 7114;
	const STATUS_UFDT_OPEN = 7117;

	const VISIT_TYPE = "('36','149','154')";
}
