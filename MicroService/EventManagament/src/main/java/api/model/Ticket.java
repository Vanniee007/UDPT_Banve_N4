package api.model;

import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;

import java.time.LocalDateTime;

@Document(collection = "Ticket")
public class Ticket {

    @Id
    private String maVe;
    private String tenVe;
    private String moTa;
    private String gia;
    private String loaiVe;
    private int tongSoVe;
    private int soVeConLai;
    private String tinhTrang;
    private String maSk;

    public String getMaVe() {
        return maVe;
    }

    public void setMaVe(String maVe) {
        this.maVe = maVe;
    }

    public String getTenVe() {
        return tenVe;
    }

    public void setTenVe(String tenVe) {
        this.tenVe = tenVe;
    }

    public String getMoTa() {
        return moTa;
    }

    public void setMoTa(String moTa) {
        this.moTa = moTa;
    }

    public String getGia() {
        return gia;
    }

    public void setGia(String gia) {
        this.gia = gia;
    }

    public String getLoaiVe() {
        return loaiVe;
    }

    public void setLoaiVe(String loaiVe) {
        this.loaiVe = loaiVe;
    }

    public int getTongSoVe() {
        return tongSoVe;
    }

    public void setTongSoVe(int tongSoVe) {
        this.tongSoVe = tongSoVe;
    }

    public int getSoVeConLai() {
        return soVeConLai;
    }

    public void setSoVeConLai(int soVeConLai) {
        this.soVeConLai = soVeConLai;
    }

    public String getTinhTrang() {
        return tinhTrang;
    }

    public void setTinhTrang(String tinhTrang) {
        this.tinhTrang = tinhTrang;
    }

    public String getMaSk() {
        return maSk;
    }

    public void setMaSk(String maSk) {
        this.maSk = maSk;
    }

    public Ticket(String maVe, String tenVe, String moTa, String gia, String loaiVe, int tongSoVe, int soVeConLai, String tinhTrang, String maSk) {
        this.maVe = maVe;
        this.tenVe = tenVe;
        this.moTa = moTa;
        this.gia = gia;
        this.loaiVe = loaiVe;
        this.tongSoVe = tongSoVe;
        this.soVeConLai = soVeConLai;
        this.tinhTrang = tinhTrang;
        this.maSk = maSk;
    }


    public Ticket() {
        super();
    }
}
