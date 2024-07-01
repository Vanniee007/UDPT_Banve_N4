package api.model;

import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;

import java.time.LocalDateTime;

@Document(collection = "Event")
public class Event {

    @Id
    private String maSk;
    private String ten;
    private String moTa;
    private String thoiLuong;
    private String diaChi;
    private LocalDateTime thoiGian;
    private LocalDateTime ngayTao;
    private String tinhTrang;
    private String maAdSk;
    private String imageData;

    public String getImageData() {
        return imageData;
    }

    public void setImageData(String imageData) {
        this.imageData = imageData;
    }

    public String getMaSk() {
        return maSk;
    }

    public void setMaSk(String maSk) {
        this.maSk = maSk;
    }

    public String getTen() {
        return ten;
    }

    public void setTen(String ten) {
        this.ten = ten;
    }

    public String getMoTa() {
        return moTa;
    }

    public void setMoTa(String moTa) {
        this.moTa = moTa;
    }

    public String getThoiLuong() {
        return thoiLuong;
    }

    public void setThoiLuong(String thoiLuong) {
        this.thoiLuong = thoiLuong;
    }

    public String getDiaChi() {
        return diaChi;
    }

    public void setDiaChi(String diaChi) {
        this.diaChi = diaChi;
    }

    public LocalDateTime getThoiGian() {
        return thoiGian;
    }

    public void setThoiGian(LocalDateTime thoiGian) {
        this.thoiGian = thoiGian;
    }
    public LocalDateTime getNgayTao() {
        return ngayTao;
    }

    public void setNgayTao(LocalDateTime ngayTao) {
        this.ngayTao = ngayTao;
    }

    public String getTinhTrang() {
        return tinhTrang;
    }

    public void setTinhTrang(String tinhTrang) {
        this.tinhTrang = tinhTrang;
    }

    public String getMaAdSk() {
        return maAdSk;
    }

    public void setMaAdSk(String maAdSk) {
        this.maAdSk = maAdSk;
    }


    public Event(String maSk, String ten, String moTa, String thoiLuong, String diaChi, LocalDateTime thoiGian, LocalDateTime ngayTao,
            String tinhTrang, String maAdSk,String imageData) {
        super();
        this.maSk = maSk;
        this.ten = ten;
        this.moTa = moTa;
        this.thoiLuong = thoiLuong;
        this.diaChi = diaChi;
        this.thoiGian = thoiGian;
        this.ngayTao = ngayTao;
        this.tinhTrang = tinhTrang;
        this.maAdSk = maAdSk;
        this.imageData = imageData;
    }

    public Event() {
        super();
    }
}
