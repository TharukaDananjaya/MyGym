import PrimaryButton from "@/Components/PrimaryButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm } from "@inertiajs/react";

export default function Schedule({ classTypes, tomorrow }) {
    const { data, setData, errors, post, processing, reset } = useForm({
        class_type_id: "",
        date: "",
        time: "",
    });
    const submit = (e) => {
        e.preventDefault();
        post(route("schedule.store"), {
            data,
            onSuccess: () => {
                reset()
            },
            onError: () => {
                console.log(errors);
            },
        });
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Schedule
                </h2>
            }
        >
            <Head title="Schedule" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-10 text-gray-900">
                            <form onSubmit={submit} className="max-w-lg">
                                <div className="space-y-6">
                                    <div>
                                        <label className="text-sm">
                                            Select type of class
                                        </label>
                                        <select
                                            name="class_type_id"
                                            className="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500"
                                            onChange={(e) =>
                                                setData(
                                                    "class_type_id",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value="">
                                                Select class type
                                            </option>
                                            {classTypes.map(
                                                (classType, index) => (
                                                    <option
                                                        key={index}
                                                        value={classType.id}
                                                    >
                                                        {classType.name}
                                                    </option>
                                                )
                                            )}
                                        </select>
                                    </div>
                                    <div className="flex gap-6">
                                        <div className="flex-1">
                                            <label className="text-sm">
                                                Date
                                            </label>
                                            <input
                                                type="date"
                                                name="date"
                                                className="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500"
                                                min={tomorrow}
                                                onChange={(e) =>
                                                    setData(
                                                        "date",
                                                        e.target.value
                                                    )
                                                }
                                            />
                                        </div>
                                        <div className="flex-1">
                                            <label className="text-sm">
                                                Time
                                            </label>
                                            <select
                                                type="time"
                                                name="time"
                                                className="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500"
                                                onChange={(e) =>
                                                    setData(
                                                        "time",
                                                        e.target.value
                                                    )
                                                }
                                            >
                                                <option value="05:00:00">
                                                    5 am
                                                </option>
                                                <option value="06:00:00">
                                                    6 am
                                                </option>
                                                <option value="07:00:00">
                                                    7 am
                                                </option>
                                                <option value="08:00:00">
                                                    8 am
                                                </option>
                                                <option value="17:00:00">
                                                    5 pm
                                                </option>
                                                <option value="18:00:00">
                                                    6 pm
                                                </option>
                                                <option value="19:00:00">
                                                    7 pm
                                                </option>
                                                <option value="20:00:00">
                                                    8 pm
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div className="text-sm text-red-600">
                                            {errors.date_time}
                                        </div>
                                    </div>
                                    <div>
                                        <PrimaryButton>Schedule</PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
