package WordScrambleGame;

public class WordScramble
{

	// Main class where the implementation class is invoked
	public static void main(String args[]) throws FileNotFoundException
	{
		WordScrambleImpl wsi = new WordScrambleImpl();
		wsi.setVisible(true);		
		wsi.playGame();
	}
}