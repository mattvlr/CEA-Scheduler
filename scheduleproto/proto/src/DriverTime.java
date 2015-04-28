
public class DriverTime {
	private String name;
	private int startTime;
	private int endTime;
	private int timesDriving;
	
	public DriverTime(String name, int startTime, int endTime){
		this.setName(name);
		this.setStartTime(startTime);
		this.setEndTime(endTime);
		timesDriving = 0;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public int getStartTime() {
		return startTime;
	}

	public void setStartTime(int startTime) {
		this.startTime = startTime;
	}

	public int getEndTime() {
		return endTime;
	}

	public void setEndTime(int endTime) {
		this.endTime = endTime;
	}

	public int getTimesDriving() {
		return timesDriving;
	}

	public void setTimesDriving(int timesDriving) {
		this.timesDriving = timesDriving;
	}
	
	public void incrementTimesDriving(int increment){
		this.timesDriving += increment;
	}
}
