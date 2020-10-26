import processing.core.*; 
import processing.data.*; 
import processing.event.*; 
import processing.opengl.*; 

import java.net.*; 
import java.util.Arrays; 
import processing.io.I2C; 

import java.util.HashMap; 
import java.util.ArrayList; 
import java.io.File; 
import java.io.BufferedReader; 
import java.io.PrintWriter; 
import java.io.InputStream; 
import java.io.OutputStream; 
import java.io.IOException; 

public class ledgrid extends PApplet {

OPC opc;
String[] recieved = new String[3];
Server server;
//what happans when the program first starts...like the start function in unity. 
public void setup()
{
  
   try {
      //ServerSocket Setup
      server = new Server();
      server.start();
      recieved = server.messages;
   }
   catch(Exception e) {
     println(e);
   }
  //size of the window
  
  
  //creates a new connection in the for of an object to the fadecandy devices. 
  //also connects to the local host. 
  opc = new OPC(this, "199.17.162.75", 7890);
  
  //spacing between each led on the window. 
  float spacing = height / 160;
  
  //0 is the starting led. 60 is the length of each strip. 
  //width/2 and height/2 besically gets the center of the led grid. 
  //angle if the grid is tilted. zigzag should be false since our strips do not zigzag.
  opc.ledGrid(0, 60, 80, width/2, height/2, spacing, spacing, 0, false, false);
  
  //new font with the size of the font. 
  PFont f = createFont("Tinos", 15);
  //sets the font for the text. 
  textFont(f);
  
}

public String scrollMessage(String text, float speed, int panel) 
{
  int ypos;
  if(panel == 1) {
    //top of the window with a bit of offset. 
    ypos = (height/2) - 20;
  }
  else if(panel == 2) {
    //middle of the window with a bit of offset. 
    ypos = (height/2) + 6;
  }
  else if(panel == 3) {
     //bottom of the window with a bit of offset. 
    ypos = (height/2) + 40; 
  }
  else {
    //top of the window with a bit of offset. 
    ypos = (height/2)  -20; 
  }
  
    
  //math to get the xpos given how fast. 
  int xpos = PApplet.parseInt( (millis() * -speed) % (textWidth(text) + width/2 + 32) );
  //actually displays the text with a given x and y position. 
  color(255,0,0);
  text(text, xpos, ypos);
  return null;
}
  
//void draw constantly draws...like the update funtion in unity. 
public void draw()
{
  background(0);
  scale(-1.0f, 1.0f);
  
  //calling the scrollMessage fucntion to display the text acroll the window every
  //frame.
   stroke(255);
   recieved = server.messages;
   String hello = (recieved[0] != null) ? scrollMessage(recieved[0], 0.04f, 1) : scrollMessage("Please wait....", 0.04f, 1);
   hello = recieved[1] != null ? scrollMessage(recieved[1], 0.04f, 2) : scrollMessage("Please wait...", 0.04f, 2);
   hello = recieved[2] != null ? scrollMessage(recieved[2], 0.04f, 3) : scrollMessage("Please wait...", 0.04f, 3);
}
public void dispose() {
  
}
/*
 * Simple Open Pixel Control client for Processing,
 * designed to sample each LED's color from some point on the canvas.
 *
 * Micah Elizabeth Scott, 2013
 * This file is released into the public domain.
 */




public class OPC implements Runnable
{
  Thread thread;
  Socket socket;
  OutputStream output, pending;
  String host;
  int port;

  int[] pixelLocations;
  byte[] packetData;
  byte firmwareConfig;
  String colorCorrection;
  boolean enableShowLocations;

  OPC(PApplet parent, String host, int port)
  {
    this.host = host;
    this.port = port;
    thread = new Thread(this);
    thread.start();
    this.enableShowLocations = true;
    parent.registerMethod("draw", this);
  }

  // Set the location of a single LED
  public void led(int index, int x, int y)  
  {
    // For convenience, automatically grow the pixelLocations array. We do want this to be an array,
    // instead of a HashMap, to keep draw() as fast as it can be.
    if (pixelLocations == null) {
      pixelLocations = new int[index + 1];
    } else if (index >= pixelLocations.length) {
      pixelLocations = Arrays.copyOf(pixelLocations, index + 1);
    }

    pixelLocations[index] = x + width * y;
  }
  
  // Set the location of several LEDs arranged in a strip.
  // Angle is in radians, measured clockwise from +X.
  // (x,y) is the center of the strip.
  public void ledStrip(int index, int count, float x, float y, float spacing, float angle, boolean reversed)
  {
    float s = sin(angle);
    float c = cos(angle);
    for (int i = 0; i < count; i++) {
      led(reversed ? (index + count - 1 - i) : (index + i),
        (int)(x + (i - (count-1)/2.0f) * spacing * c + 0.5f),
        (int)(y + (i - (count-1)/2.0f) * spacing * s + 0.5f));
    }
  }

  // Set the locations of a ring of LEDs. The center of the ring is at (x, y),
  // with "radius" pixels between the center and each LED. The first LED is at
  // the indicated angle, in radians, measured clockwise from +X.
  public void ledRing(int index, int count, float x, float y, float radius, float angle)
  {
    for (int i = 0; i < count; i++) {
      float a = angle + i * 2 * PI / count;
      led(index + i, (int)(x - radius * cos(a) + 0.5f),
        (int)(y - radius * sin(a) + 0.5f));
    }
  }

  // Set the location of several LEDs arranged in a grid. The first strip is
  // at 'angle', measured in radians clockwise from +X.
  // (x,y) is the center of the grid.
  public void ledGrid(int index, int stripLength, int numStrips, float x, float y,
               float ledSpacing, float stripSpacing, float angle, boolean zigzag,
               boolean flip)
  {
    float s = sin(angle + HALF_PI);
    float c = cos(angle + HALF_PI);
    for (int i = 0; i < numStrips; i++) {
      ledStrip(index + stripLength * i, stripLength,
        x + (i - (numStrips-1)/2.0f) * stripSpacing * c,
        y + (i - (numStrips-1)/2.0f) * stripSpacing * s, ledSpacing,
        angle, zigzag && ((i % 2) == 1) != flip);
    }
  }

  // Set the location of 64 LEDs arranged in a uniform 8x8 grid.
  // (x,y) is the center of the grid.
  public void ledGrid8x8(int index, float x, float y, float spacing, float angle, boolean zigzag,
                  boolean flip)
  {
    ledGrid(index, 8, 8, x, y, spacing, spacing, angle, zigzag, flip);
  }

  // Should the pixel sampling locations be visible? This helps with debugging.
  // Showing locations is enabled by default. You might need to disable it if our drawing
  // is interfering with your processing sketch, or if you'd simply like the screen to be
  // less cluttered.
  public void showLocations(boolean enabled)
  {
    enableShowLocations = enabled;
  }
  
  // Enable or disable dithering. Dithering avoids the "stair-stepping" artifact and increases color
  // resolution by quickly jittering between adjacent 8-bit brightness levels about 400 times a second.
  // Dithering is on by default.
  public void setDithering(boolean enabled)
  {
    if (enabled)
      firmwareConfig &= ~0x01;
    else
      firmwareConfig |= 0x01;
    sendFirmwareConfigPacket();
  }

  // Enable or disable frame interpolation. Interpolation automatically blends between consecutive frames
  // in hardware, and it does so with 16-bit per channel resolution. Combined with dithering, this helps make
  // fades very smooth. Interpolation is on by default.
  public void setInterpolation(boolean enabled)
  {
    if (enabled)
      firmwareConfig &= ~0x02;
    else
      firmwareConfig |= 0x02;
    sendFirmwareConfigPacket();
  }

  // Put the Fadecandy onboard LED under automatic control. It blinks any time the firmware processes a packet.
  // This is the default configuration for the LED.
  public void statusLedAuto()
  {
    firmwareConfig &= 0x0C;
    sendFirmwareConfigPacket();
  }    

  // Manually turn the Fadecandy onboard LED on or off. This disables automatic LED control.
  public void setStatusLed(boolean on)
  {
    firmwareConfig |= 0x04;   // Manual LED control
    if (on)
      firmwareConfig |= 0x08;
    else
      firmwareConfig &= ~0x08;
    sendFirmwareConfigPacket();
  } 

  // Set the color correction parameters
  public void setColorCorrection(float gamma, float red, float green, float blue)
  {
    colorCorrection = "{ \"gamma\": " + gamma + ", \"whitepoint\": [" + red + "," + green + "," + blue + "]}";
    sendColorCorrectionPacket();
  }
  
  // Set custom color correction parameters from a string
  public void setColorCorrection(String s)
  {
    colorCorrection = s;
    sendColorCorrectionPacket();
  }

  // Send a packet with the current firmware configuration settings
  public void sendFirmwareConfigPacket()
  {
    if (pending == null) {
      // We'll do this when we reconnect
      return;
    }
 
    byte[] packet = new byte[9];
    packet[0] = (byte)0x00; // Channel (reserved)
    packet[1] = (byte)0xFF; // Command (System Exclusive)
    packet[2] = (byte)0x00; // Length high byte
    packet[3] = (byte)0x05; // Length low byte
    packet[4] = (byte)0x00; // System ID high byte
    packet[5] = (byte)0x01; // System ID low byte
    packet[6] = (byte)0x00; // Command ID high byte
    packet[7] = (byte)0x02; // Command ID low byte
    packet[8] = (byte)firmwareConfig;

    try {
      pending.write(packet);
    } catch (Exception e) {
      dispose();
    }
  }

  // Send a packet with the current color correction settings
  public void sendColorCorrectionPacket()
  {
    if (colorCorrection == null) {
      // No color correction defined
      return;
    }
    if (pending == null) {
      // We'll do this when we reconnect
      return;
    }

    byte[] content = colorCorrection.getBytes();
    int packetLen = content.length + 4;
    byte[] header = new byte[8];
    header[0] = (byte)0x00;               // Channel (reserved)
    header[1] = (byte)0xFF;               // Command (System Exclusive)
    header[2] = (byte)(packetLen >> 8);   // Length high byte
    header[3] = (byte)(packetLen & 0xFF); // Length low byte
    header[4] = (byte)0x00;               // System ID high byte
    header[5] = (byte)0x01;               // System ID low byte
    header[6] = (byte)0x00;               // Command ID high byte
    header[7] = (byte)0x01;               // Command ID low byte

    try {
      pending.write(header);
      pending.write(content);
    } catch (Exception e) {
      dispose();
    }
  }

  // Automatically called at the end of each draw().
  // This handles the automatic Pixel to LED mapping.
  // If you aren't using that mapping, this function has no effect.
  // In that case, you can call setPixelCount(), setPixel(), and writePixels()
  // separately.
  public void draw()
  {
    if (pixelLocations == null) {
      // No pixels defined yet
      return;
    }
    if (output == null) {
      return;
    }

    int numPixels = pixelLocations.length;
    int ledAddress = 4;

    setPixelCount(numPixels);
    loadPixels();

    for (int i = 0; i < numPixels; i++) {
      int pixelLocation = pixelLocations[i];
      int pixel = pixels[pixelLocation];

      packetData[ledAddress] = (byte)(pixel >> 16);
      packetData[ledAddress + 1] = (byte)(pixel >> 8);
      packetData[ledAddress + 2] = (byte)pixel;
      ledAddress += 3;

      if (enableShowLocations) {
        pixels[pixelLocation] = 0xFFFFFF ^ pixel;
      }
    }

    writePixels();

    if (enableShowLocations) {
      updatePixels();
    }
  }
  
  // Change the number of pixels in our output packet.
  // This is normally not needed; the output packet is automatically sized
  // by draw() and by setPixel().
  public void setPixelCount(int numPixels)
  {
    int numBytes = 3 * numPixels;
    int packetLen = 4 + numBytes;
    if (packetData == null || packetData.length != packetLen) {
      // Set up our packet buffer
      packetData = new byte[packetLen];
      packetData[0] = (byte)0x00;              // Channel
      packetData[1] = (byte)0x00;              // Command (Set pixel colors)
      packetData[2] = (byte)(numBytes >> 8);   // Length high byte
      packetData[3] = (byte)(numBytes & 0xFF); // Length low byte
    }
  }
  
  // Directly manipulate a pixel in the output buffer. This isn't needed
  // for pixels that are mapped to the screen.
  public void setPixel(int number, int c)
  {
    int offset = 4 + number * 3;
    if (packetData == null || packetData.length < offset + 3) {
      setPixelCount(number + 1);
    }

    packetData[offset] = (byte) (c >> 16);
    packetData[offset + 1] = (byte) (c >> 8);
    packetData[offset + 2] = (byte) c;
  }
  
  // Read a pixel from the output buffer. If the pixel was mapped to the display,
  // this returns the value we captured on the previous frame.
  public int getPixel(int number)
  {
    int offset = 4 + number * 3;
    if (packetData == null || packetData.length < offset + 3) {
      return 0;
    }
    return (packetData[offset] << 16) | (packetData[offset + 1] << 8) | packetData[offset + 2];
  }

  // Transmit our current buffer of pixel values to the OPC server. This is handled
  // automatically in draw() if any pixels are mapped to the screen, but if you haven't
  // mapped any pixels to the screen you'll want to call this directly.
  public void writePixels()
  {
    if (packetData == null || packetData.length == 0) {
      // No pixel buffer
      return;
    }
    if (output == null) {
      return;
    }

    try {
      output.write(packetData);
    } catch (Exception e) {
      dispose();
    }
  }

  public void dispose()
  {
    // Destroy the socket. Called internally when we've disconnected.
    // (Thread continues to run)
    if (output != null) {
      println("Disconnected from OPC server");
    }
    socket = null;
    output = pending = null;
  }

  public void run()
  {
    // Thread tests server connection periodically, attempts reconnection.
    // Important for OPC arrays; faster startup, client continues
    // to run smoothly when mobile servers go in and out of range.
    for(;;) {

      if(output == null) { // No OPC connection?
        try {              // Make one!
          socket = new Socket(host, port);
          socket.setTcpNoDelay(true);
          pending = socket.getOutputStream(); // Avoid race condition...
          println("Connected to OPC server");
          sendColorCorrectionPacket();        // These write to 'pending'
          sendFirmwareConfigPacket();         // rather than 'output' before
          output = pending;                   // rest of code given access.
          // pending not set null, more config packets are OK!
        } catch (ConnectException e) {
          dispose();
        } catch (IOException e) {
          dispose();
        }
      }

      // Pause thread to avoid massive CPU load
      try {
        Thread.sleep(500);
      }
      catch(InterruptedException e) {
      }
    }
  }
}


// TSL2561 is light sensor using I2C
// datasheet: https://cdn-shop.adafruit.com/datasheets/TSL2561.pdf
// code contributed by @OlivierLD

public class TSL2561 extends I2C {

  public final static int TSL2561_ADDRESS = 0x39;

  public final static int TSL2561_ADDRESS_LOW = 0x29;
  public final static int TSL2561_ADDRESS_FLOAT = 0x39;
  public final static int TSL2561_ADDRESS_HIGH = 0x49;

  public final static int TSL2561_COMMAND_BIT = 0x80;
  public final static int TSL2561_WORD_BIT = 0x20;
  public final static int TSL2561_CONTROL_POWERON = 0x03;
  public final static int TSL2561_CONTROL_POWEROFF = 0x00;

  public final static int TSL2561_REGISTER_CONTROL = 0x00;
  public final static int TSL2561_REGISTER_TIMING = 0x01;
  public final static int TSL2561_REGISTER_CHAN0_LOW = 0x0C;
  public final static int TSL2561_REGISTER_CHAN0_HIGH = 0x0D;
  public final static int TSL2561_REGISTER_CHAN1_LOW = 0x0E;
  public final static int TSL2561_REGISTER_CHAN1_HIGH = 0x0F;
  public final static int TSL2561_REGISTER_ID = 0x0A;

  public final static int TSL2561_GAIN_1X = 0x00;
  public final static int TSL2561_GAIN_16X = 0x10;

  public final static int TSL2561_INTEGRATIONTIME_13MS = 0x00; // rather 13.7ms
  public final static int TSL2561_INTEGRATIONTIME_101MS = 0x01;
  public final static int TSL2561_INTEGRATIONTIME_402MS = 0x02;

  public final static double TSL2561_LUX_K1C = 0.130f;   // (0x0043)  // 0.130 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B1C = 0.0315f;  // (0x0204)  // 0.0315 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M1C = 0.0262f;  // (0x01ad)  // 0.0262 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K2C = 0.260f;   // (0x0085)  // 0.260 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B2C = 0.0337f;  // (0x0228)  // 0.0337 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M2C = 0.0430f;  // (0x02c1)  // 0.0430 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K3C = 0.390f;   // (0x00c8)  // 0.390 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B3C = 0.0363f;  // (0x0253)  // 0.0363 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M3C = 0.0529f;  // (0x0363)  // 0.0529 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K4C = 0.520f;   // (0x010a)  // 0.520 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B4C = 0.0392f;  // (0x0282)  // 0.0392 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M4C = 0.0605f;  // (0x03df)  // 0.0605 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K5C = 0.65f;    // (0x014d)  // 0.65 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B5C = 0.0229f;  // (0x0177)  // 0.0229 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M5C = 0.0291f;  // (0x01dd)  // 0.0291 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K6C = 0.80f;    // (0x019a)  // 0.80 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B6C = 0.0157f;  // (0x0101)  // 0.0157 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M6C = 0.0180f;  // (0x0127)  // 0.0180 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K7C = 1.3f;     // (0x029a)  // 1.3 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B7C = 0.00338f; // (0x0037)  // 0.00338 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M7C = 0.00260f; // (0x002b)  // 0.00260 * 2^LUX_SCALE
  public final static double TSL2561_LUX_K8C = 1.3f;     // (0x029a)  // 1.3 * 2^RATIO_SCALE
  public final static double TSL2561_LUX_B8C = 0.000f;   // (0x0000)  // 0.000 * 2^LUX_SCALE
  public final static double TSL2561_LUX_M8C = 0.000f;   // (0x0000)  // 0.000 * 2^LUX_SCALE

  private int gain = TSL2561_GAIN_1X;
  private int integration = TSL2561_INTEGRATIONTIME_402MS;
  private int pause = 800;

  private int address;


  public TSL2561(String dev) {
    this(dev, TSL2561_ADDRESS);
  }

  public TSL2561(String dev, int address) {
    super(dev);
    this.address = address;
    start();
  }

  public void start() {
    command(TSL2561_COMMAND_BIT, (byte) TSL2561_CONTROL_POWERON);
  }

  public void stop() {
    command(TSL2561_COMMAND_BIT, (byte) TSL2561_CONTROL_POWEROFF);
  }

  public void setGain() {
    setGain(TSL2561_GAIN_1X);
  }

  public void setGain(int gain) {
    setGain(gain, TSL2561_INTEGRATIONTIME_402MS);
  }

  public void setGain(int gain, int integration) {
    if (gain != TSL2561_GAIN_1X && gain != TSL2561_GAIN_16X) {
      throw new IllegalArgumentException("Invalid gain value");
    }
    if (gain != this.gain || integration != this.integration) {
      command(TSL2561_COMMAND_BIT | TSL2561_REGISTER_TIMING, (byte) (gain | integration));
      //println("Setting low gain");
      this.gain = gain;
      this.integration = integration;
      delay(pause); // pause for integration (pause must be bigger than integration time)
    }
  }

  /**
   * Read visible+IR diode from the I2C device
   */
  public int readFull() {
    int reg = TSL2561_COMMAND_BIT | TSL2561_REGISTER_CHAN0_LOW;
    return readU16(reg);
  }

  /**
   * Read IR only diode from the I2C device
   */
  public int readIR() {
    int reg = TSL2561_COMMAND_BIT | TSL2561_REGISTER_CHAN1_LOW;
    return readU16(reg);
  }

  /**
   * Device lux range 0.1 - 40,000+
   * see https://learn.adafruit.com/tsl2561/overview
   */
  public float lux() {
    int ambient = this.readFull();
    int ir = this.readIR();

    //println("IR Result: " + ir);
    //println("Ambient Result: " + ambient);

    if (ambient >= 0xffff || ir >= 0xffff) {
      throw new RuntimeException("Gain too high, values exceed range");
    }
    double ratio = (ir / (float) ambient);

    /*
     * For the values below, see https://github.com/adafruit/_TSL2561/blob/master/_TSL2561_U.h
     */
    float lux = 0.0f;
    if ((ratio >= 0) && (ratio <= TSL2561_LUX_K4C)) {
      lux = (float)((TSL2561_LUX_B1C * ambient) - (0.0593f * ambient * (Math.pow(ratio, 1.4f))));
    } else if (ratio <= TSL2561_LUX_K5C) {
      lux = (float)((TSL2561_LUX_B5C * ambient) - (TSL2561_LUX_M5C * ir));
    } else if (ratio <= TSL2561_LUX_K6C) {
      lux = (float)((TSL2561_LUX_B6C * ambient) - (TSL2561_LUX_M6C * ir));
    } else if (ratio <= TSL2561_LUX_K7C) {
      lux = (float)((TSL2561_LUX_B7C * ambient) - (TSL2561_LUX_M7C * ir));
    } else if (ratio > TSL2561_LUX_K8C) {
      lux = 0.0f;
    }
    return lux;
  }


  private void command(int register, byte value) {
    beginTransmission(address);
    write(register);
    write(value);
    endTransmission();
  }

  private int readU8(int register) {
    beginTransmission(this.address);
    write(register);
    byte[] ba = read(1);
    endTransmission();
    return (int)(ba[0] & 0xFF);
  }

  private int readU16(int register) {
    int lo = readU8(register);
    int hi = readU8(register + 1);
    int result = (hi << 8) + lo; // Big Endian
    //println("(U16) I2C: Device " + toHex(TSL2561_ADDRESS) + " returned " + toHex(result) + " from reg " + toHex(register));
    return result;
  }

  private String toHex(int i) {
    String s = Integer.toString(i, 16).toUpperCase();
    while (s.length() % 2 != 0) {
      s = "0" + s;
    }
    return "0x" + s;
  }
}
  public void settings() {  size(600, 300); }
  static public void main(String[] passedArgs) {
    String[] appletArgs = new String[] { "ledgrid" };
    if (passedArgs != null) {
      PApplet.main(concat(appletArgs, passedArgs));
    } else {
      PApplet.main(appletArgs);
    }
  }
}
