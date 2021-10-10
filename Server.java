import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.io.IOException;

public class Server extends Thread {
    protected static int numberOfPanels = 3;
    protected static String[] messages = new String[numberOfPanels];
    public void run() {
        try {
            final int portNumber = 4444;
            ServerSocket serverSocket = new ServerSocket(portNumber);
            while (true) {
                System.out.println("Waiting for new connection....");
                Socket socket = serverSocket.accept();
                OutputStream os = socket.getOutputStream();
                PrintWriter pw = new PrintWriter(os, true);

                BufferedReader br = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                String line;
                while ((line = br.readLine()) != null) {
                    System.out.println("Client response: " + line);
                    pw.println(line);
                    messages = line.split("&");
                    
                }
            }
            // pw.close();
            // br.close();
            // os.close();
            // socket.close();
            // serverSocket.close();
        }
        catch(IOException E) {
            System.out.println(E.getMessage());
        }
    }
}
