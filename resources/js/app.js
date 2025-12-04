import 'bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';
import QRCode from 'qrcode';

// DataTables
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-buttons-bs5';

// Hacer DataTable disponible globalmente
window.DataTable = DataTable;
window.QRCode = QRCode;

console.log(QRCode);