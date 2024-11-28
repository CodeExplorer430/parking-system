import { useState } from "react";
import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import VehicleForm from "./VehicleForm";

interface ParkingSlotsProps {
  category: "sticker" | "no-sticker";
}

interface SlotType {
  type: string;
  available: number;
  occupied: number;
}

const ParkingSlots = ({ category }: ParkingSlotsProps) => {
  const [showForm, setShowForm] = useState(false);
  const [slots] = useState<SlotType[]>([
    { type: "2 Wheels", available: 50, occupied: 10 },
    { type: "3 to 4 Wheels", available: 30, occupied: 15 },
    { type: "6 and UP Wheels", available: 20, occupied: 5 },
  ]);

  return (
    <div className="space-y-6 fade-in">
      <div className="grid md:grid-cols-3 gap-4">
        {slots.map((slot) => (
          <Card key={slot.type} className="p-6 glass-panel">
            <h3 className="text-lg font-semibold mb-4">{slot.type}</h3>
            <div className="space-y-2">
              <p>Available: {slot.available}</p>
              <p>Occupied: {slot.occupied}</p>
              <Button
                onClick={() => setShowForm(true)}
                className="w-full mt-4 button-hover"
              >
                Serve Slot
              </Button>
            </div>
          </Card>
        ))}
      </div>

      {showForm && (
        <VehicleForm onClose={() => setShowForm(false)} category={category} />
      )}
    </div>
  );
};

export default ParkingSlots;