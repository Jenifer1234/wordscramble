import java.util.Random;
import java.util.Scanner;
import java.io.*;
public class ReadScramleWord
{
	private int high,low;  // Starting and ending number of words in scramle.txt.If the no. of words is 24, the high value is 24
	public ReadScramleWord()
	{
		low = 1;
		high = 24;
	}	
	public ReadScramleWord(int l,int h)
	{
		low = l;
		high = h;
	}
	
	//Scrambled word is given to the player by reading from a file where in scrambled words are split by line breaks. Hence a random word from the file will be shown to the player
	
	public String getScramleWord() throws FileNotFoundException
	{
		Scanner in = new Scanner(new File("scramle.txt"));
		int wordNum = rand(1, 24);
		int lineCount = 1;
		String word = "";
		while (true)
		{
			word = in.nextLine();
			if (word == null) // EOF
				break;
			if (lineCount == wordNum)
				break;
			else
				lineCount++;
		}
		System.out.println(word + "\t" + wordNum );
		in.close();
		return word;
	}
	
	// To find number
	public int rand(int low, int high) 
	{
		return low + (int)(Math.random() * (high - low + 1));
	}
}
