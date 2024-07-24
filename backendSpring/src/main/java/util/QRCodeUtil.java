package util;

import com.google.zxing.BarcodeFormat;
import com.google.zxing.EncodeHintType;
import com.google.zxing.WriterException;
import com.google.zxing.common.BitMatrix;
import com.google.zxing.qrcode.QRCodeWriter;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.Base64;
import java.util.HashMap;
import java.util.Map;

public class QRCodeUtil {
    public static String generateQRCode(String data) throws WriterException, IOException {
        QRCodeWriter qrCodeWriter = new QRCodeWriter();
        Map<EncodeHintType, Object> hints = new HashMap<>();
        hints.put(EncodeHintType.MARGIN, 1); // Margin around the QR code
        BitMatrix bitMatrix = qrCodeWriter.encode(data, BarcodeFormat.QR_CODE, 120, 120, hints);

        BufferedImage bufferedImage = new BufferedImage(120, 120, BufferedImage.TYPE_INT_RGB);
        bufferedImage.createGraphics();

        for (int y = 0; y < 120; y++) {
            for (int x = 0; x < 120; x++) {
                int grayValue = (bitMatrix.get(x, y) ? 0 : 1) & 0xff;
                bufferedImage.setRGB(x, y, (grayValue == 0 ? 0 : 0xFFFFFF));
            }
        }

        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        ImageIO.write(bufferedImage, "png", byteArrayOutputStream);
        byte[] pngData = byteArrayOutputStream.toByteArray();
        return Base64.getEncoder().encodeToString(pngData);
    }
}