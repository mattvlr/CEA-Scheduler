
public class StudentTime {

	private int universityID;
	private int rideTime;
	private String pickupPlace;
	private String dropPlace;
	private String day;
	
	public StudentTime(int universityID, int rideTime, String pickupPlace, String dropPlace){
		this.setUniversityID(universityID);
		this.setRideTime(rideTime);
		this.setPickupPlace(pickupPlace);
		this.setDropPlace(dropPlace);
		//this.day = day;
	}

	public String getPickupPlace() {
		return pickupPlace;
	}

	public void setPickupPlace(String pickupPlace) {
		this.pickupPlace = pickupPlace;
	}

	public String getDropPlace() {
		return dropPlace;
	}

	public void setDropPlace(String dropPlace) {
		this.dropPlace = dropPlace;
	}

	public int getRideTime() {
		return rideTime;
	}

	public void setRideTime(int rideTime) {
		this.rideTime = rideTime;
	}

	public int getUniversityID() {
		return universityID;
	}

	public void setUniversityID(int universityID) {
		this.universityID = universityID;
	}

}
