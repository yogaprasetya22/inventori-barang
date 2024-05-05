export const validateRole = (role) => {
    switch (role) {
        case 1:
            return "admin";
        case 2:
            return "owner";
        case 3:
            return "mekanik";
    }
};

export const validateHeader = (role) => {
    switch (role) {
        case 1:
            return "admin";
        case 2:
            return "owner";
        case 3:
            return "mekanik";
    }
};

export function formatRupiah(angka, prefix) {
    // Periksa apakah angka negatif
    var isNegative = angka < 0;

    // Ambil nilai absolut dari angka
    var absAngka = Math.abs(angka);

    var number_string = absAngka.toString().replace(/[^,\d]/g, ""),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        var separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

    // Tambahkan tanda minus jika angka negatif
    if (isNegative) {
        rupiah = "-" + rupiah;
    }

    return prefix == undefined ? rupiah : rupiah ? "Rp" + rupiah : "";
}
