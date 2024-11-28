import { useState } from "react";
import { Card } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { useToast } from "@/components/ui/use-toast";

interface VehicleFormProps {
  onClose: () => void;
  category: "sticker" | "no-sticker";
}

const VehicleForm = ({ onClose, category }: VehicleFormProps) => {
  const [plateNo, setPlateNo] = useState("");
  const [vehicleColor, setVehicleColor] = useState("");
  const [brand, setBrand] = useState("");
  const [model, setModel] = useState("");
  const { toast } = useToast();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    toast({
      title: "Vehicle registered",
      description: "The vehicle has been successfully registered.",
    });
    onClose();
  };

  return (
    <Card className="p-6 max-w-md mx-auto glass-panel fade-in">
      <h2 className="text-xl font-semibold mb-4">Register Vehicle</h2>
      <form onSubmit={handleSubmit} className="space-y-4">
        <div className="space-y-2">
          <label className="text-sm font-medium">Plate No</label>
          <Input
            value={plateNo}
            onChange={(e) => setPlateNo(e.target.value)}
            placeholder="Enter plate number"
          />
        </div>

        <div className="space-y-2">
          <label className="text-sm font-medium">Vehicle Color</label>
          <Input
            value={vehicleColor}
            onChange={(e) => setVehicleColor(e.target.value)}
            placeholder="Enter vehicle color"
          />
        </div>

        <div className="space-y-2">
          <label className="text-sm font-medium">Brand</label>
          <Select onValueChange={setBrand}>
            <SelectTrigger>
              <SelectValue placeholder="Select brand" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="toyota">Toyota</SelectItem>
              <SelectItem value="honda">Honda</SelectItem>
              <SelectItem value="ford">Ford</SelectItem>
              <SelectItem value="bmw">BMW</SelectItem>
            </SelectContent>
          </Select>
        </div>

        <div className="space-y-2">
          <label className="text-sm font-medium">Model</label>
          <Input
            value={model}
            onChange={(e) => setModel(e.target.value)}
            placeholder="Enter model"
          />
        </div>

        <div className="flex gap-2 justify-end">
          <Button type="button" variant="outline" onClick={onClose}>
            Cancel
          </Button>
          <Button type="submit">Submit</Button>
        </div>
      </form>
    </Card>
  );
};

export default VehicleForm;