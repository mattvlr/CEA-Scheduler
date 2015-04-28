
import java.util.ArrayList;

public class QuickSort {
	ArrayList<StudentTime> array;
	
	public QuickSort(ArrayList<StudentTime> array){
		this.array = array;
	}
	
	public void sort(){
		quicksortStart(array.size()/2);
	}
	
	private void quicksortStart(int pivotIndex){
		for(int i = 0; i < array.size(); i++){
			if(array.get(i).getRideTime() > array.get(pivotIndex).getRideTime() && i < pivotIndex){
				StudentTime temp = array.get(pivotIndex);
				array.set(pivotIndex, array.get(i));
				array.set(i, temp);
			}
			else if(array.get(i).getRideTime() < array.get(pivotIndex).getRideTime() && i > pivotIndex){ 
				StudentTime temp = array.get(i);
				array.set(i, array.get(pivotIndex));
				array.set(pivotIndex, temp);
				pivotIndex = i;
			}
		}
		
		quicksortLower(0, pivotIndex);
		quicksortUpper(pivotIndex, array.size()-1);
	}
	
	private void quicksortLower(int lowerBound, int upperBound){
		int pivotIndex = (upperBound+lowerBound)/2;
		
		for(int i = lowerBound; i <= upperBound; i++){
			if(array.get(i).getRideTime() > array.get(pivotIndex).getRideTime() && i < pivotIndex){
				StudentTime temp = array.get(pivotIndex);
				array.set(pivotIndex, array.get(i));
				array.set(i, temp);
			}
			else if(array.get(i).getRideTime() < array.get(pivotIndex).getRideTime() && i > pivotIndex){ 
				StudentTime temp = array.get(i);
				array.set(i, array.get(pivotIndex));
				array.set(pivotIndex, temp);
				pivotIndex = i;
			}
		}
		
		if(upperBound - lowerBound< 2)
			return;
		else{
			quicksortLower(lowerBound, pivotIndex);
			quicksortUpper(pivotIndex, upperBound);
		}
	}
	
	private void quicksortUpper(int lowerBound, int upperBound){
		int pivotIndex = (upperBound+lowerBound)/2;
		
		for(int i = lowerBound; i <= upperBound; i++){
			if(array.get(i).getRideTime() > array.get(pivotIndex).getRideTime() && i < pivotIndex){
				StudentTime temp = array.get(pivotIndex);
				array.set(pivotIndex, array.get(i));
				array.set(i, temp);
			}
			else if(array.get(i).getRideTime() < array.get(pivotIndex).getRideTime() && i > pivotIndex){ 
				StudentTime temp = array.get(i);
				array.set(i, array.get(pivotIndex));
				array.set(pivotIndex, temp);
				pivotIndex = i;
			}
		}
		
		if(upperBound - lowerBound < 2)
			return;
		else{
			quicksortLower(lowerBound, pivotIndex);
			quicksortUpper(pivotIndex, upperBound);
		}
	} 
}